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
# - NAME         : People
# - FILE_NAME    : People.php
# - Type         : Class (People)
# - Namespace    : App\Entity;


namespace App\Entity;

use DateTimeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class People
 * @package App\Entity
 * @ORM\Entity
 */
class People
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     *
     * @Groups("people:read")
     */
    private ?int $id;
    /**
     * @var string
     * @ORM\Column()
     *
     * @Groups("people:read")
     *
     * @Assert\NotBlank
     * @Assert\Length(max=250)
     */
    private string $firstName;
    /**
     * @var string|null
     * @ORM\Column(nullable=true)
     *
     * @Groups("people:read")
     *
     * @Assert\Length(max=250)
     */
    private ?string $lastName;
    /**
     * @var string
     * @ORM\Column(type="string",length=1)
     *
     * @Groups("people:read")
     *
     * @Assert\NotBlank
     * @Assert\Length(max=1)
     */
    private string $sex;
    /**
     * @var DateTimeInterface
     * @ORM\Column(type="date")
     *
     * @Groups("people:read")
     *
     * @Assert\NotBlank
     * @Assert\Date
     */
    private DateTimeInterface $naissance;
    /**
     * @var string
     * @ORM\Column()
     *
     * @Groups("people:read")
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
     * @var Metier[]
     */
    private array $metier;
    /**
     * People constructor.
     */
    public function __construct()
    {
    }
    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $sex
     * @param string $cover
     * @param DateTimeInterface $naissance
     * @return static
     */
    public static function CREATE(
        string $firstName,
        string $lastName,
        string $sex,
        string $cover,
        DateTimeInterface $naissance
    ): self {
        $people = new self();
        $people->firstName = $firstName;
        $people->lastName = $lastName;
        $people->sex = $sex;
        $people->cover = $cover;
        $people->naissance = $naissance;
        return $people;
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
    public function getFirstName(): string
    {
        return $this->firstName;
    }
    /**
     * @param string $firstName
     */
    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }
    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }
    /**
     * @param string|null $lastName
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }
    /**
     * @return string
     */
    public function getSex(): string
    {
        return $this->sex;
    }
    /**
     * @param string $sex
     */
    public function setSex(string $sex): void
    {
        $this->sex = $sex;
    }
    /**
     * @return DateTimeInterface
     */
    public function getNaissance(): DateTimeInterface
    {
        return $this->naissance;
    }
    /**
     * @param DateTimeInterface $naissance
     */
    public function setNaissance(DateTimeInterface $naissance): void
    {
        $this->naissance = $naissance;
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
}
