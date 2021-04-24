<?php

namespace App\Controller\Admin;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * New.
     *
     * @Route("/admin/artiste/create", name="admin.artiste.new")
     *
     * @return void
     */
    public function new(Request $request)
    {
        $artiste = new Artist();

        $form = $this->createForm(ArtistType::class, $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($artiste);
            $this->em->flush();
            $this->addFlash('success', 'Artiste Créer avec succès');

            return $this->redirectToRoute('admin.artiste.index');
        }

        return $this->render('/admin/artiste/new.html.twig', [
            'artiste' => $artiste,
            'form' => $form->createView(),
        ]);
    }

    /**======================================================== */

    /**
     * Edit.
     *
     * @Route("/admin/artiste/{id}", name="admin.artiste.edit", methods="GET|POST")
     *
     * @return void
     */
    public function edit(Request $request, Artist $artiste)
    {
        $form = $this->createForm(ArtistType::class, $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($artiste);
            $this->em->flush();
            $this->addFlash('success', 'Artiste Modifié avec succès');

            return $this->redirectToRoute('admin.artiste.index');
        }

        return $this->render('/admin/artiste/edit.html.twig', [
            'artiste' => $artiste,
            'form' => $form->createView(),
        ]);
    }

    /**======================================================== */

    /**
     * Delete.
     *
     * @Route("/admin/artiste/{id}", name="admin.artiste.delete", methods="DELETE")
     *
     * @return void
     */
    public function delete(Artist $artiste, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$artiste->getId(), $request->get('_token'))) {
            $this->em->remove($artiste);
            $this->em->flush();
            $this->addFlash('success', 'Artiste supprimé avec succès');
        }

        return $this->redirectToRoute('admin.artiste.index');
    }
}
