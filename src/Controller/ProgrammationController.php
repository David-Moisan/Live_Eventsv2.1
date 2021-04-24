<?php

namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammationController extends AbstractController
{
    /**
     * @Route("/programmation", name="programmation")
     */
    public function index(ProgramRepository $repo, ArtistRepository $repoArtiste): Response
    {
        $program = $repo->findAll();
        $aritste = $repoArtiste->findAll();

        return $this->render('programmation/index.html.twig', [
            'program' => $program,
            'artiste' => $aritste,
        ]);
    }
}
