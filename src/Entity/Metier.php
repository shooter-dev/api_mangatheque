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
# - Created      : 02/10/2020
# - PROJECT_NAME : api_mangatheque
# - Directory    :
# - NAME         : Metier
# - FILE_NAME    : Metier.php
# - Type         : Class (Metier)
# - Namespace    : App\Enity;


namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Metier
 * @package App\Entity
 * @ORM\Entity
 */
class Metier
{
    /**
     * @var People
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="People")
     */
    private People $people;
    /**
     * @var Job
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Job")
     */
    private Job $job;
    /**
     * @var Tome
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Tome")
     */
    private Tome $tome;
}
