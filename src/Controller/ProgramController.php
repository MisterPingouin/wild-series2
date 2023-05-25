<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\Request;

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

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository) : Response
    {
        $program = new Program();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);
    
        if ($form->isSubmitted()) {
            $programRepository->save($program, true);            

            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/new.html.twig', [
            'form' => $form,
        ]);
    }
    
#[Route('/{id}', name: 'show')]
public function show(Program $program): Response
{
  return $this->render('program/show.html.twig', ['program'=>$program]);
}


// #[Route('/{id}', name: 'show')]
//     public function show(int $id, ProgramRepository $programRepository): Response
//     {
//         $program = $programRepository->find($id);
    
//         if (!$program) {
//             throw $this->createNotFoundException(
//                 'No program found for id ' . $id
//             );
//         }
    
//         return $this->render('/program/show.html.twig', ['program' => $program]);
//    }

    
/**   #[Route('/{id}', methods: ['GET'], requirements: ['id'=>'\d+'], name: 'show')]
 *   public function show(int $id, ProgramRepository $programRepository): Response
 *  {
 *      $program = $programRepository->findOneby(['id' => $id]);
*if (!$program) {
*    throw $this->createNotFoundException( ' No program with id : '  .$id.' found in program\'s table. ');
*}
*        return $this->render('program/show.html.twig', [
*            'program' =>  $program,  
*        ]);
*    }
*/

/**
 * @Route("/program/{program}/comment/{comment}", name="program_show_comment")
 */
#[Route('/{program}/season/{season}', name: 'season_show')]
public function showSeason(Program $program, Season $season): Response
{
  return $this->render('program/season_show.html.twig', [
    'program' => $program,
    'season' => $season,
  ]);
}

#[Route('/{program}/season/{season}/episode/{episode}', name: 'episode_show')]
public function showEpisode(Program $program, Season $season, Episode $episode) : Response
{
    return $this->render('program/episode_show.html.twig', [
        'program' => $program,
        'season' => $season,
        'episode' => $episode,
      ]);
}

//     #[Route('/{programId}/season/{seasonId}', methods: ['GET'], requirements: ['programId'=>'\d+', 'seasonId'=>'\d+'], name: 'season_show')]
// public function showSeason(int $programId, int $seasonId, ProgramRepository $programRepository): Response
// {
//     $program = $programRepository->findOneBy(['id' => $programId]);

//     if (!$program) {
//         throw $this->createNotFoundException('No program with id ' . $programId . ' found in the program\'s table.');
//     }

//     $season = null;
//     foreach ($program->getSeasons() as $s) {
//         if ($s->getId() === $seasonId) {
//             $season = $s;
//             break;
//         }
//     }

//     if (!$season) {
//         throw $this->createNotFoundException('No season with id ' . $seasonId . ' found for the program with id ' . $programId);
//     }

//     return $this->render('program/season_show.html.twig', [
//         'program' => $program,
//         'season' => $season,
//     ]);
// }

}
