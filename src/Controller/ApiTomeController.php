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
# - Created      : 03/10/2020
# - PROJECT_NAME : api_mangatheque
# - Directory    :
# - NAME         : ApiTomeController
# - FILE_NAME    : ApiTomeController.php
# - Type         : Class (ApiTomeController)
# - Namespace    : App\Controller;


namespace App\Controller;

use App\Repository\TomeRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

  /**
 * Class ApiTomeController
 * @package App\Controller
 * @Route(
 *     "/tomes"
 * )
 */
class ApiTomeController
{
    /**
     * @Route(
     *     name="api_tomes_collection_get",
     *     methods={"GET"}
     *     )
     *
     * @param TomeRepository $tomeRepository
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function collection(TomeRepository $tomeRepository, SerializerInterface $serializer): JsonResponse
    {
        return new JsonResponse(
            $serializer->serialize($tomeRepository->findAll(), "json", ["groups" => "get"]),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }
}
