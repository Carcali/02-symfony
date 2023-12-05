<?php
// src/Controller/ProgramController.php
namespace App\Controller;


use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    /*#[Route('/program/', name: 'program_index')]
    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
        ]);
    }*/

    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', ['programs' => $programs]);
    }

    /*#[Route('/program/{page}', methods: ['GET'], requirements: ['page' => '\d+'], name: 'program_')]
    public function show(int $page = 1): Response
    {
        return $this->render('program/show.html.twig', [
            'page' => $page,
        ]);
    }*/

    /*#[Route('/show/{id<^[0-9]+$>}', name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        // same as $program = $programRepository->find($id);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }*/

    #[Route('/{id}', name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);

        return $this->render('program/show.html.twig', ['programs' => $program]);
    }

    #[Route('/{programId}/seasons/{seasonId}', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->find($programId);
        $season = $seasonRepository->find($seasonId);
        $episode = $season->getEpisodes();

        return $this->render('program/season_show.html.twig', ['seasons' => $season, 'programs' => $program, 'episodes' => $episode]);
    }
}
