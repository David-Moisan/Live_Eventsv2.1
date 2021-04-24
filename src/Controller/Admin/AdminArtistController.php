<?php

namespace App\Controller\Admin;

use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminArtistController extends AbstractController
{
    private $em;
    private $repo;

    public function __construct(ArtistRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /**======================================================== */

    /**
     * Index.
     *
     * @Route("/admin/artiste/index", name="admin.artiste.index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $artiste = $this->repo->findAll();

        return $this->render('/admin/artiste/index.html.twig', compact('artiste'));
    }

    /**======================================================== */

    public function edit()
    {
        // code...
    }

    /**======================================================== */

    public function new()
    {
        // code...
    }

    /**======================================================== */

    public function delete()
    {
        // code...
    }
}
