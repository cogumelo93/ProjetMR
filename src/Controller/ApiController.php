<?php


namespace App\Controller;

use App\AppService\ApiService;
use App\Entity\Project;
use App\Entity\Teams;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{

    private $apiService;
    private $entity;

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

    /**
     *  @Route("/lister", name="")
     *
     */
    public function ApiBDD(){
        //l'ID en dur
        $id = '21256897';
        //De quoi gérer les entités
        $em = $this->getDoctrine()->getManager();

        //$viewlist devient l'objectRepository de l'entité Teams
        $viewlist = $this->getDoctrine()->getRepository(Teams::class);
        //Projectbddid devient l'objectRepository de l'entité Project
        $Projectbddid = $this->getDoctrine()->getRepository(Project::class);

        //$teams renvoie la ligne avec l'id 1 dans la table Teams
        $teams = $viewlist->findOneBy(array('id'=>'1'));

        //$project renvoie la ligne avec l'id choisi dans la table projects
        $project = $Projectbddid->findOneBy(array('id'=>'1'));
        //Si la ligne n'existe pas il la créér
        if(!$project){

        }
        $project_id = $em->getRepository(Project::class)->findOneBy(['id' => $id]);
        $teams->addProjectId($project);


        $em->persist($teams);

        $em->flush();

        return new Response('toto');




        //$teams->addProjectId();







    }
}


