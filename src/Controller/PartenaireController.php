<?php

namespace App\Controller;

use App\Repository\CategoriePartenairesRepository;
use App\Repository\PartenairesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenaireController extends AbstractController
{
    /**
     * @Route("/partenaire", name="partenaire.index")
     */
    public function index(PartenairesRepository $repo, CategoriePartenairesRepository $categorieRepo): Response
    {
        $partenaires = $repo->findAll();
        $categorie = $categorieRepo->findAll();

        return $this->render('partenaire/index.html.twig', [
            'partenaires' => $partenaires,
            'categorie' => $categorie,
        ]);
    }
}
