<?php


namespace App\Controller;

use App\Entity\Project;
use App\Entity\Teams;
use App\Forms\createTeamForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Gitlab\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\AppService\ApiService;

class projectController extends AbstractController
{
    private $client;

    public function __construct(Client $client, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->client = $client;
        $this->index();
    }




    public function addProject(Request $request, $id ) {


        $Project = new Project();
        $Project->setIdProject($request->query->get($id));


        $this->entityManager->persist($Project);
        $this->entityManager->flush($Project);


        return new \Symfony\Component\HttpFoundation\Response($Project->getIdProject());
    }
}
