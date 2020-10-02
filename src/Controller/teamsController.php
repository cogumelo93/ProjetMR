<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Teams;
use Gitlab\Client;
use Twig\Environment;
use App\Forms\createTeamForm;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class teamsController extends AbstractController
{
    /**
    * @var Environment
    */
    private $twig;
    private $entity;
    private $client;
    /**
    * DefaultController constructor.
    * @param Environment $twig
    */

    public function __construct(Environment $twig, EntityManagerInterface $entity,Client $client)
    {
        $this->twig = $twig;
        $this->entity = $entity;
        $this->client = $client;
    }

    public function index()
    {
        $issues = $this->client->projects()->all(['owned' => true]);
        foreach($issues as $issue) {
            $id=$issue["id"];
            //dump(array_search("id", $issue));die();
            $re = $this->client->mergeRequests()->all($id);
            //dump($re);die();
        }
        return ($re);
    }

    /**
     * @Route("/home", name="home")
     */

    public function homeTeam(Request $request)
     {

        /** @var TeamsRepository $viewlist */

        $viewlist = $this->entity->getRepository(Teams::class);

        $teams = $viewlist->findAll();


        return $this->render('/homeTeamView.html.twig', ['teams' => $teams]
         );

       }

    /**
     * @Route("/array", name="array")
     */
     public function projectlists(){

         $theo = $this->index();
         $arrayID = [];

         foreach($theo as $issue) {
             $title=$issue["title"];
             //$arrayID = [];
             array_push($arrayID, $title);
         }

         return $this->render('/arrayid.html.twig', ['arrayID' => $arrayID]
         );



     }





    /**
     * @Route("/createteam", name="form")
     */

    public function addTeam(Request $request)
    {

        $team = new Teams();

        $form = $this->createForm(createTeamForm::class, $team);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entity->persist($team);
            $this->entity->flush($team);
            return $this->redirectToRoute('home');
        }

        return $this->render('/formTeamView.html.twig', array('form' => $form->createView(),
        ));

    }

    /**
     * @Route("/manageteam", name="manageteam")
     */

    public function viewTeam()
    {
        /** @var TeamsRepository $viewlist */

        $viewlist = $this->entity->getRepository(Teams::class);

        $teams = $viewlist->findAll();

        return $this->render('/manageTeam.html.twig', ['teams' => $teams]
         );
    }

    /**
     * @Route("/deleteteam/{id}", name="deleteteam")
     */

    public function deleteTeam(int $id)
    {

        $sup = $this->entity->getRepository(Teams::class);
        $teamtodelete = $sup->findOneById($id);
        $this->entity->remove($teamtodelete);
        $this->entity->flush();
        return $this->redirectToRoute('home');

    }

    /**
     * @Route("/updateteam/{id}", name="updateteam")
     */

    public function updateTeam(int $id, Request $request)
    {
        $teams = $this->entity->getRepository(Teams::class);
        $teamtoupdate = $teams->findOneById($id);

        /** @var Teams $teams */

        $form = $this->createForm(createTeamForm::class, $teamtoupdate);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entity->persist($teamtoupdate);
            $this->entity->flush();
            return $this->redirectToRoute('home');
        }

        $display = $this->twig->render('formTeamView.html.twig', [
                'form' => $form->createView(),
                'case' => true
                ]);
                return new Response($display);
    }

}