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
# - NAME         : ForgottenPasswordInput
# - FILE_NAME    : ForgottenPasswordInput.php
# - Type         : Class (ForgottenPasswordInput)
# - Namespace    : App\Dto;

//declare(strict_types=1);


namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\EmailExists;

/**
 * Class ForgottenPasswordInput
 * @package App\Dto
 */
class ForgottenPasswordInput
{
    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Email
     * @EmailExists
     */
    private string $email = "";
    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
}
