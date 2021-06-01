<?php

// src/Controller/ProgramController.php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;

use App\Entity\Program;

use App\Entity\Season;

use App\Entity\Episode;


/**
 * @Route("/programs", name="program_")
 */

class ProgramController extends AbstractController

{

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

    public function show(int $id): Response
    {
        $program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findOneBy(['id' => $id]);

        $seasons = $this->getDoctrine()
        ->getRepository(Season::class)
        ->findBy(['program'=>$program]);

    if (!$program) {
        throw $this->createNotFoundException(
            'No program with id : '.$id.' found in program\'s table.'
        );
    }
    return $this->render('program/show.html.twig', [
        'program' => $program, 'seasons' => $seasons
    ]);
    }

    /**
    * Getting a season by id and by program
    *
    * @Route("/{programId<^[0-9]+$>}/seasons/{seasonId<^[0-9]+$>}", name="season_show")
    * @entity("season", expr="repository.find(seasonId)")
    * @return Response
    */

    public function showSeason(Program $programId, Season $seasonId): Response
    {
        $program = $this->getDoctrine()
        ->getRepository(Program::class)
        ->findOneBy(['id' => $programId]);

        $season = $this->getDoctrine()
        ->getRepository(Season::class)
        ->findOneBy(['id'=>$seasonId]);

        $episodes = $this->getDoctrine()
        ->getRepository(Episode::class)
        ->findBy(['season'=>$season]);

    if (!$season) {
        throw $this->createNotFoundException(
            'No season with id : '.$seasonId.' found in season\'s table.'
        );
    }
    return $this->render('program/season_show.html.twig', [
        'program' => $program, 'season' => $season, 'episodes' => $episodes
    ]);
    }
}

