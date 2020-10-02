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
     * @Route("/list", name="")
     *
     */

    public function index()
    {


        $issues = $this->client->projects()->all(['owned' => true]);
        foreach($issues as $issue) {

            $id=$issue["id"];
            dump($id);
            //dump(array_search("id", $issue));die();
            $re = $this->client->mergeRequests()->all($id);
            dump($re);
        }
        die();
        
    }

}


