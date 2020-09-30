<?php


namespace App\Controller;

use App\AppService\ApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    private $apiService;

    public function __construct(ApiService $ApiService)
    {
        $this->apiService = $ApiService;
    }



    /**
     * @Route("/test")
     * @return Response
     */

    public function api()
    {
        $test = $this->apiService->merge("21221266");

        return (new Response("toto"));
    }
    //72732854

}


