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
# - NAME         : Bibliotheque
# - FILE_NAME    : Bibliotheque.php
# - Type         : Class (Bibliotheque)
# - Namespace    : App\Entity;


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

/**
 * Class Bibliotheque
 * @package App\Entity
 * @ORM\Entity
 */
class Bibliotheque
{
    /**
    * @var User* @ORM\Id
    * @ORM\ManyToOne(targetEntity="User", inversedBy="tracklist")
    */
    private User $user;
    /**
    * @var Tome[]|Collection
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity="Tome", inversedBy="albumsFeaturingThisTrack")
    */
    private Collection $tomes;
    /**
     * @var DateTimeInterface
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $dateAchat;


    /**
     * Bibliotheque constructor.
     */
    public function __construct()
    {
        $this->tomes = new ArrayCollection();
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return Tome[]|Collection
     */
    public function getTomes(): Collection
    {
        return $this->tomes;
    }

    /**
     * @param Tome[]|Collection $tomes
     */
    public function setTomes(Collection $tomes): void
    {
        $this->tomes = $tomes;
    }

    /**
     * @return DateTimeInterface
     */
    public function getDateAchat(): DateTimeInterface
    {
        return $this->dateAchat;
    }

    /**
     * @param DateTimeInterface $dateAchat
     */
    public function setDateAchat(DateTimeInterface $dateAchat): void
    {
        $this->dateAchat = $dateAchat;
    }
}
