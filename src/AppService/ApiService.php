<?php


namespace App\AppService;

use Gitlab\Client;

class ApiService
{

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }




    public function merge()
    {
        $issues = $this->client->mergeRequests()->all();
        $idProject = $issues;
        dump($issues);die;
        return($idProject);

    }
    //72732854

}