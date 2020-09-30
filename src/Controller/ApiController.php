<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gitlab\Client;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    private $client;

    public function __construct( Client $client) {
        $this->client = $client;
    }

    /**
     * @Route("/list", name="")
     */

    public function index() {

        $issues = $this->client->mergeRequests()->all();
        dump($issues);die;

    }
}


