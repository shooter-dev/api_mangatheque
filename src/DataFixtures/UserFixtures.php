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
# - Created      : 08/10/2020
# - PROJECT_NAME : api_mangatheque
# - Directory    :
# - NAME         : UserFixtures
# - FILE_NAME    : UserFixtures.php
# - Type         : Class (UserFixtures)
# - Namespace    : App\DataFixtures;

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $userPasswordEncoderInterface;
    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoderInterface
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoderInterface)
    {
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
    }
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        //$admin->setId(Uuid::v4());
        $admin->setEmail("admin@shooterdev.fr");
        $admin->setPassword($this->userPasswordEncoderInterface->encodePassword($admin, "password"));
        $admin->setFirstName("admin");
        $admin->setLastName("admin");

        $manager->persist($admin);
        $manager->flush();

        $user = new Utilisateur();
        //$user->setId(Uuid::v4());
        $user->setEmail("user@shooterdev.fr");
        $user->setPassword($this->userPasswordEncoderInterface->encodePassword($user, "password"));
        $user->setFirstName("user");
        $user->setLastName("Shooter");

        $manager->persist($user);
        $manager->flush();

        /*for ($i = 1; $i <= 10; $i++) {
            $user = new Utilisateur();
            $admin->setEmail(sprintf("user%d@shooterdev.fr", $i));
            $user->setPassword($this->userPasswordEncoderInterface->encodePassword($user, "password"));
            $user->setFirstName(sprintf("user-%d", $i));
            $user->setLastName("Dupont");

            echo sprintf("Create user%d \n", $i);

            $manager->persist($user);
            $manager->flush();
        }*/
    }
}
