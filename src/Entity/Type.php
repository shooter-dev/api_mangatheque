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
# - NAME         : Type
# - FILE_NAME    : Type.php
# - Type         : Class (Type)
# - Namespace    : App\Enity;


namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Type
 * @package App\Entity
 * @ORM\Entity
 */
class Type
{
    /**
     * @var int|null
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *
     * @Groups("type:read")
     */
    private ?int $id;
    /**
     * @var string
     * @ORM\Column(unique=true)
     *
     * @Groups("type:read")
     *
     * @Assert\NotBlank
     * @Assert\Length(max=250)
     */
    private string $name;
    /**
     * @var string
     * @ORM\Column()
     *
     * @Groups("type:read")
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
     * Editor constructor.
     */
    public function __construct()
    {
    }
    /**
     * @param string $name
     * @param string $cover
     * @return static
     */
    public static function CREATE(
        string $name,
        string $cover
    ): self {
        $type = new self();
        $type->name = $name;
        $type->cover = $cover;
        return $type;
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
