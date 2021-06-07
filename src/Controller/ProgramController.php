<?php

// src/Controller/ProgramController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

use Symfony\Component\HttpFoundation\Request;

use App\Form\ProgramType;

use App\Entity\Program;

use App\Entity\Season;

use App\Entity\Episode;


/**
 * @Route("/programs", name="program_")
 */

class ProgramController extends AbstractController

{

    /**
     * The controller for the program add form
     * Display the form or deal with it
     * 
     * @Route("/new", name="new")
     */
    public function new(Request $request) : Response
    {
        // Create a new Program Object
        $program = new Program();
        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted()) {
            // Deal with the submitted data
            // Get the Entity Manager
        $entityManager = $this->getDoctrine()->getManager();
        // Persist Category Object
        $entityManager->persist($program);
        // Flush the persisted object
        $entityManager->flush();
        // Finally redirect to categories list
        return $this->redirectToRoute('program_index');
        }
        // Render the form
        return $this->render('program/new.html.twig', [
            "form" => $form->createView(),
        ]);
    }

    /**
     * Show all rows from Program's entity
     * 
     * @Route("/", name="index")
     * @return Response A response instance
     */

    public function index(): Response

    {

            $programs = $this->getDoctrine()
                ->getRepository(Program::class)
                ->findAll();

            return $this->render(
                'program/index.html.twig',
                ['programs' => $programs]
            );


    }

    /**
    * Getting a program by id
    *
    * @Route("/show/{id<^[0-9]+$>}", name="show")
    * @return Response
    */

    public function show(Program $program): Response
    {

        $seasons = $program->getSeason();

    return $this->render('program/show.html.twig', [
        'program' => $program, 'seasons' => $seasons
    ]);
    }

    /**
    * Getting a season by id and by program
    *
    * @Route("/{programId}/seasons/{seasonId}", name="season_show")
    * @return Response
    */

    public function showSeason(Program $programId, Season $seasonId): Response
    {
        $episodes = $seasonId->getEpisode();

    return $this->render('program/season_show.html.twig', [
        'program' => $programId, 'season' => $seasonId, 'episodes' => $episodes
    ]);
    }

    /**
    * Getting a Episode by id and by program and season
    *
    * @Route("/{programId}/seasons/{seasonId}/episodes{episodeId}", name="episode_show")
    * @return Response
    */

    public function showEpisode(Program $programId, Season $seasonId, Episode $episodeId): Response
    {
        

    return $this->render('program/episode_show.html.twig', [
        'program' => $programId, 'season' => $seasonId, 'episode' => $episodeId
    ]);
    }
    

}