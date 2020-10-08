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
# - NAME         : ForgottenPassword
# - FILE_NAME    : ForgottenPassword.php
# - Type         : Class (ForgottenPassword)
# - Namespace    : App\Entity;

//declare(strict_types=1);

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;

/**
 * Class ForgottenPassword
 * @package App\Entity
 * @ORM\Embeddable
 */
class ForgottenPassword
{
    /**
     * @var ?string
     * @ORM\Column(type="uuid", unique=true, nullable=true)
     */
    private ?string $token = null;
    /**
     * @var ?DateTimeImmutable
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $requestedAt = null;

    /**
     * ForgottenPassword constructor.
     */
    public function __construct()
    {
        $this->token = Uuid::v4();
        $this->requestedAt = new DateTimeImmutable();
    }
    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }
    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }
    /**
     * @return DateTimeImmutable|null
     */
    public function getRequestedAt(): ?DateTimeImmutable
    {
        return $this->requestedAt;
    }
    /**
     * @param DateTimeImmutable|null $requestedAt
     */
    public function setRequestedAt(?DateTimeImmutable $requestedAt): void
    {
        $this->requestedAt = $requestedAt;
    }
}
