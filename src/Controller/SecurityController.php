<?php

#   _____ __   __ ____   ____ _______ ______ _____        *
#  / ____| |  | |/ __ \ / __ \__   __|  ____|  __ \      **
# | (___ | |__| | |  | | |  | | | |  | |__  | |__) |    ***
#  \___ \|  __  | |  | | |  | | | |  |  __| |  _  /    ****
#  ____) | |  | | |__| | |__| | | |  | |____| | \ \   *****
# /_____/|_|  |_|\____/ \____/  |_|  |______|_|  \_\ ******
#                                          ***************************
#                                            ***********************
#                                              ****************_____  ________      __
#                                               *****    **** |  __ \|  ____\ \    / /
#                                              ***        *** | |  | | |__   \ \  / /
#                                             **           ** | |  | |  __|   \ \/ /
#                                            *              * | |__| | |____   \  /
#                                                             |_____/|______|   \/
# - Author       : shooterdev
# - Created      : 07/10/2020
# - PROJECT_NAME : api_mangatheque
# - Directory    :
# - NAME         : SecurityController
# - FILE_NAME    : SecurityController.php
# - Type         : Class (SecurityController)
# - Namespace    : App\Controller;

declare(strict_types=1);

namespace App\Controller;

use App\Dto\ForgottenPasswordInput;
use App\Entity\Admin;
use App\Entity\Utilisateur;
use App\Entity\User;
use App\Form\ForgottenPasswordType;
use App\Form\RegistrationType;
use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Uid\Uuid;

/**
 * Class SecurityController
 * @package App\Controller
 */
class SecurityController extends AbstractController
{
    /**
     * @param string $role
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     * @Route("/registration/{role}", name="security_registration")
     */
    public function registration(string $role, Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $user = Admin::ROLE === $role ? new Admin() : new Utilisateur();
        $user->setId(Uuid::v4());

        $form = $this->createForm(RegistrationType::class, $user, [
            "validation_groups" => ["Default", "password"]
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $encoder->encodePassword($user, $user->getPlainPassword())
            );
            $this->getDoctrine()->getManager()->persist($user);
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash("success", "Votre inscription a été effectuée avec succès.");
            return $this->redirectToRoute("index");
        }

        return $this->render("ui/security/registration.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     * @Route("/login", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render("ui/security/login.html.twig", [
            "last_username" => $authenticationUtils->getLastUsername(),
            "error" => $authenticationUtils->getLastAuthenticationError()
        ]);
    }
    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout(): void
    {
    }

    /**
     * @Route("/forgotten-password", name="security_forgotten_password")
     * @param Request $request
     * @param UserRepository $repository
     * @param MailerInterface $mailer
     * @return Response
     */
    public function forgottenPassword(Request $request, UserRepository $repository, MailerInterface $mailer): Response
    {
        $forgottenPasswordInput = new ForgottenPasswordInput();

        $form = $this->createForm(ForgottenPasswordType::class, $forgottenPasswordInput)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $user */
            $user = $repository->findOneByEmail($forgottenPasswordInput->getEmail());
            $user->hasForgotHisPassword();

            $this->getDoctrine()->getManager()->flush();

            $email = (new TemplatedEmail())
                ->to(new Address($user->getEmail(), $user->getFullName()))
                ->from("hello@mangatheque.com")
                ->context(["forgottenPassword" => $user->getForgottenPassword()])
                ->htmlTemplate('emails/forgotten_password.html.twig');
            $mailer->send($email);

            $this->addFlash(
                "success",
                "Votre demande d'oubli de mot de pass a bien été enregistrée.
                Vous allez recevoir un email pour réinitialiser votre mot de pass"
            );
            return $this->redirectToRoute("security_login");
        }

        return $this->render("ui/security/forgotten_password.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/reset-password/{token}", name="security_reset_password")
     * @param string $token
     * @param Request $request
     * @param UserRepository $userRepository
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @return Response
     * @throws NonUniqueResultException
     */
    public function resetPassword(
        string $token,
        Request $request,
        UserRepository $userRepository,
        UserPasswordEncoderInterface $userPasswordEncoder
    ): Response {
        if (!Uuid::isValid($token)
            || null === ($user = $userRepository->getUserByForgottenPasswordToken(Uuid::fromString($token)))
        ) {
            $this->addFlash("danger", "Cette demande d'oubli de mot de passe n'existe pas.");
            return $this->redirectToRoute("security_login");
        }

        $form = $this->createForm(ResetPasswordType::class, $user, [
            "validation_groups" => ["password"]
        ])->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordEncoder->encodePassword($user, $user->getPlainPassword())
            );
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                "success",
                "Votre mot de passe a été modifié avec succès."
            );
            return $this->redirectToRoute("security_login");
        }

        return $this->render("ui/security/reset_password.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
