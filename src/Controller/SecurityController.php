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

namespace App\Controller;

use App\Entity\Admin;
use App\Entity\Utilisateur;
use App\Form\RegistrationType;
use App\Entity\User;
//use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
//use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
//use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
            //$this->addFlash("success", "Votre inscription a été effectuée avec succès.");
            return $this->redirectToRoute("index");
        }

        return $this->render("ui/security/registration.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
