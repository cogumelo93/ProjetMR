<?php

namespace App\Controller;

use App\Entity\Teams;
use Twig\Environment;
use App\Forms\createTeamForm;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/team")
 */

class teamsController extends AbstractController
{
    /**
    * @var Environment
    */
    private $twig;
    private $entity;
    /**
    * DefaultController constructor.
    * @param Environment $twig
    */

    public function __construct(Environment $twig, EntityManagerInterface $entity)
    {
        $this->twig = $twig;
        $this->entity = $entity;
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
        }

        return $this->render('/createTeamView.html.twig', array('form' => $form->createView(),
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

    public function deleteTeam(int $id) {

        $sup = $this->entity->getRepository(Teams::class);
        $teamtodelete = $sup->findOneById($id);
        $this->entity->remove($teamtodelete);
        $this->entity->flush();
        return $this->redirectToRoute('manageteam');

    }

}