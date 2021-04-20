<?php

namespace App\Controller\Admin;

use App\Entity\ProgramForDay;
use App\Form\ProgramForDayType;
use App\Repository\ProgramForDayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProgramForDayController extends AbstractController
{
    private $repo;
    private $em;

    public function __construct(ProgramForDayRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /*====================================================================================*/

    /**
     * Index.
     *
     * @Route("/admin/artiste/index", name="admin.artist.index")
     *
     * @return void
     */
    public function index()
    {
        $artistes = $this->repo->findAll();

        return $this->render('admin/artist/index.html.twig', compact('artistes'));
    }

    /*====================================================================================*/

    /**
     * Edit.
     *
     * @Route("/admin/artiste/edit/{id}", name="admin.artist.edit", methods="GET|POST")
     *
     * @return void
     */
    public function edit(ProgramForDay $artiste, Request $request)
    {
        $form = $this->createForm(ProgramForDayType::class, $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($artiste);
            $this->em->flush();
            $this->addFlash('success', 'Artiste modifié avec succès !');

            return $this->redirectToRoute('admin.artist.index');
        }

        return $this->render('/admin/artist/edit.html.twig', [
            'artiste' => $artiste,
            'form' => $form->createView(),
        ]);
    }

    /*====================================================================================*/

    /**
     * New.
     *
     * @Route("/admin/artiste/creation", name="admin.artist.new")
     *
     * @return void
     */
    public function new(Request $request)
    {
        $artiste = new ProgramForDay();
        $form = $this->createForm(ProgramForDayType::class, $artiste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($artiste);
            $this->em->flush();
            $this->addFlash('success', 'Artiste créé avec succès');

            return $this->redirectToRoute('admin.artist.index');
        }

        return $this->render('/admin/artist/new.html.twig', [
            'artiste' => $artiste,
            'form' => $form->createView(),
        ]);
    }

    /* ============================================================== */

    /**
     * Delete .
     *
     * @Route("/admin/artiste/delete/{id}", name="admin.artist.delete", methods="DELETE")
     *
     * @return void
     */
    public function delete(ProgramForDay $artiste, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$artiste->getId(), $request->get('_token'))) {
            $this->em->remove($artiste);
            $this->em->flush();
            $this->addFlash('success', 'Artiste supprimé avec succès');
        }

        return $this->redirectToRoute('admin.artist.index');
    }
}
