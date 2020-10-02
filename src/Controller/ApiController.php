<?php


namespace App\Controller;

use App\AppService\ApiService;
use App\Entity\Project;
use App\Repository\TeamsRepository;
use Gitlab\Client;
use App\Entity\Teams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    private $apiService;
    private $client;
    private $entity;

    public function __construct(ApiService $ApiService, Client $client)
    {
        $this->apiService = $ApiService;
        $this->client = $client;
    }


    /**
     * @Route("/lissdf", name="dfs")
     *
     */


    public function index()
    {
        $issues = $this->client->projects()->all(['owned' => true]);
        foreach($issues as $issue) {
            $id=$issue["id"];
            //dump(array_search("id", $issue));die();
            $re = $this->client->mergeRequests()->all($id);

        }
        return ($re);
    }


    /**
     * @Route("/list/{id}", name="")
     *
     */


    public function ApiBDD($id){
        //l'ID en dur
        $theo = $this->index();


        foreach ($theo as $id) {
            //De quoi gérer les entités

            $em = $this->getDoctrine()->getManager();

            //$viewlist devient l'objectRepository de l'entité Teams
            $viewlist = $this->getDoctrine()->getRepository(Teams::class);
            //Projectbddid devient l'objectRepository de l'entité Project
            $Projectbddid = $this->getDoctrine()->getRepository(Project::class);

            //$teams renvoie la ligne avec l'id 1 dans la table Teams
            $teams = $viewlist->findOneBy(array('id' => $id));

            //$project renvoie la ligne avec l'id choisi dans la table projects
            $project = $Projectbddid->findOneBy(array('id_project' => $id['project_id']));

            //Si la ligne n'existe pas il la créé

            if (!$project) {
                $proFN = new Project();
                $proFN = $proFN->setIdProject($id['project_id']);
                $em->persist($proFN);
                $em->flush();
                $project = $proFN;
                //return new Response('ca marche pas bg');
            }

            //$project_id = $em->getRepository(Project::class)->findOneBy(['id' => $id]);
            $teams->addProjectId($project);


            $em->persist($teams);

            $em->flush();
        }
        return new Response('toto');


        //$teams->addProjectId();


    }
}


