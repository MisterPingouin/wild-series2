<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
$programs = $programRepository->findAll();

        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
            'programs' => $programs
        ]);
    }


    #[Route('/{id}', methods: ['GET'], requirements: ['id'=>'\d+'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneby(['id' => $id]);
if (!$program) {
    throw $this->createNotFoundException( ' No program with id : '  .$id.' found in program\'s table. ');
}
        return $this->render('program/show.html.twig', [
            'program' =>  $program,  
        ]);
    }

    #[Route('/{programId}/season/{seasonId}', methods: ['GET'], requirements: ['programId'=>'\d+', 'seasonId'=>'\d+'], name: 'season_show')]
public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository): Response
{
    $program = $programRepository->findOneBy(['id' => $programId]);

    if (!$program) {
        throw $this->createNotFoundException('No program with id ' . $programId . ' found in the program\'s table.');
    }

    $season = null;
    foreach ($program->getSeasons() as $s) {
        if ($s->getId() === $seasonId) {
            $season = $s;
            break;
        }
    }

    if (!$season) {
        throw $this->createNotFoundException('No season with id ' . $seasonId . ' found for the program with id ' . $programId);
    }

    return $this->render('program/season_show.html.twig', [
        'program' => $program,
        'season' => $season,
    ]);
}

}
