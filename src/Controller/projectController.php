<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gitlab\Client;
use Symfony\Component\Routing\Annotation\Route;
use App\AppService\ApiService;

class projectController extends AbstractController
{
    private $client;

    public function __construct( Client $client) {
        $this->client = $client;
        $this->index();
    }


    /**
     * @Route("/list", name="")
     */

    public function index() {

        $issues = $this->client->mergeRequests()->all('21256854');
        dump($issues);die;

    }
}