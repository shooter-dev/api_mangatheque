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
# - NAME         : Tome
# - FILE_NAME    : Tome.php
# - Type         : Class (Tome)
# - Namespace    : App\Enity;


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Tome
 * @package App\Entity
 * @ORM\Entity
 */
class Tome
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string",length=13)
     *
     * @Groups({"tome:read"})
     *
     * @Assert\NotBlank
     * @Assert\Length(min=13, max=13)
     * @Assert\Isbn(
     *     type = "isbn13",
     *     message = "This value is not  valid."
     * )
     */
    private string $id;
    /**
     * @var string
     * @ORM\Column(unique=true)
     *
     * @Groups({"tome"})
     *
     * @Assert\NotBlank
     * @Assert\Length(max=250)
     */
    private string $name;
    /**
     * @var float
     * @ORM\Column(type="float")
     *
     * @Groups({"tome"})
     *
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private float $volume;
    /**
     * @var int
     * @ORM\Column(type="integer")
     *
     * @Groups({"tome"})
     *
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private int $pages;
    /**
     * @var DateTimeInterface
     * @ORM\Column(type="date")
     */
    private DateTimeInterface $dateSortie;
    /**
     * @var string
     * @ORM\Column(type="text")
     *
     * @Groups({"tome"})
     *
     * @Assert\NotBlank
     * @Assert\Length(max=1000)
     */
    private string $resumer;
    /**
     * @var string
     * @ORM\Column()
     *
     * @Groups({"tome"})
     *
     * @Assert\NotBlank
     * @Assert\Length(min=5,max=50)
     * @Assert\File(
     *     maxSize = "5M",
     *     mimeTypes = {"application/jpg", "application/png"},
     *     mimeTypesMessage = "Please upload a valid Image"
     * )
     */
    private string $cover;
    /**
     * @var Editor
     * @ORM\ManyToOne(targetEntity="Editor")
     *
     * @Groups({"tome"})
     */
    private Editor $editor;
    /**
     * @var Serie
     * @ORM\ManyToOne(targetEntity="Serie")
     *
     * @Groups({"tome"})
     */
    private Serie $serie;
    /**
     * @var Metier[]|Collection
     */
    private Collection $metier;
    /**
     * @ORM\OneToMany(targetEntity="Bibliotheque", mappedBy="tome")
     */
    protected $usersFeaturingThisTomes;
    /**
     * Tome constructor.
     */
    public function __construct()
    {
        $this->metier = new ArrayCollection();
    }
    /**
     * @param string $name
     * @param string $cover
     * @param float $volume
     * @param int $pages
     * @param DateTimeInterface $dateSortie
     * @return static
     */
    public static function CREATE(
        string $name,
        string $cover,
        float $volume,
        int $pages,
        DateTimeInterface $dateSortie
    ): self {
        $serie = new self();
        $serie->name = $name;
        $serie->cover = $cover;
        $serie->volume = $volume;
        $serie->pages = $pages;
        $serie->dateSortie = $dateSortie;
        return $serie;
    }
}
