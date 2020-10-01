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
     * @Route("/te")
     * @return Response
     */

    public function apibdd(){

        $bdd = $this->apiService->merge()->all();

        return (new Response("toto"));

    }
    //72732854

}


