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
# - NAME         : Serie
# - FILE_NAME    : Serie.php
# - Type         : Class (Serie)
# - Namespace    : App\Enity;


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Serie
 * @package App\Entity
 * @ORM\Entity
 */
class Serie
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @Groups("serie:read")
     */
    private ?int $id;
    /**
     * @var string
     * @ORM\Column(unique=true)
     *
     * @Groups("serie:read")
     *
     * @Assert\NotBlank
     * @Assert\Length(max=250)
     */
    private string $name;
    /**
     * @var float
     * @ORM\Column(type="float")
     *
     * @Groups("serie:read")
     *
     * @Assert\NotBlank
     * @Assert\Positive
     */
    private float $volumes;
    /**
     * @var string
     * @ORM\Column()
     *
     * @Groups("serie:read")
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
     * @var Type
     * @ORM\ManyToOne(targetEntity="Type", cascade={"persist"})
     */
    private Type $type;
    /**
     * @var Genre[]|Collection
     * @ORM\ManyToMany(targetEntity="Genre", inversedBy="series")
     * @ORM\JoinTable(name="serie_by_genres")
     */
    private Collection $genres;
    /**
     * @var Tome[]|Collection
     */
    private Collection $tomes;
    /**
     * Serie constructor.
     */
    public function __construct()
    {
        $this->genres = new ArrayCollection();
        $this->tomes  = new ArrayCollection();
    }
    /**
     * @param string $name
     * @param string $cover
     * @param float $volumes
     * @param Type $type
     * @param Genre[]|ArrayCollection $genres
     * @return static
     */
    public static function CREATE(
        string $name,
        string $cover,
        float $volumes,
        Type $type,
        ArrayCollection $genres
    ): self {
        $serie = new self();
        $serie->name = $name;
        $serie->cover = $cover;
        $serie->volumes = $volumes;
        $serie->type = $type;
        $serie->genres = $genres;
        return $serie;
    }
    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }
    /**
     * @return float
     */
    public function getVolumes(): float
    {
        return $this->volumes;
    }
    /**
     * @param float $volumes
     */
    public function setVolumes(float $volumes): void
    {
        $this->volumes = $volumes;
    }
    /**
     * @return string
     */
    public function getCover(): string
    {
        return $this->cover;
    }
    /**
     * @param string $cover
     */
    public function setCover(string $cover): void
    {
        $this->cover = $cover;
    }
    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }
    /**
     * @param Type $type
     */
    public function setType(Type $type): void
    {
        $this->type = $type;
    }
    /**
     * @return Genre[]|Collection
     */
    public function getGenres()
    {
        return $this->genres;
    }
    /**
     * @param Genre[]|Collection $genres
     */
    public function setGenres($genres): void
    {
        $this->genres = $genres;
    }
    /**
     * @return Tome[]|Collection
     */
    public function getTomes()
    {
        return $this->tomes;
    }
    /**
     * @param Tome[]|Collection $tomes
     */
    public function setTomes($tomes): void
    {
        $this->tomes = $tomes;
    }
    /**
     * @param Genre $genre
     */
    public function genreBy(Genre $genre): void
    {
        if ($this->genres->contains($genre)) {
            return;
        }

        $this->genres->add($genre);
    }
    /**
     * @param Genre $genre
     */
    public function disGenreBy(Genre $genre): void
    {
        if (!$this->genres->contains($genre)) {
            return;
        }

        $this->genres->removeElement($genre);
    }
}
