<?php

namespace App\Controller\Admin;

use App\Entity\Partenaires;
use App\Form\PartenairesType;
use App\Repository\PartenairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminPartenairesController extends AbstractController
{
    private $em;
    private $repo;

    public function __construct(PartenairesRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /**================================================================================== */

    /**
     * Index partenaires.
     *
     * @Route("/admin/partenaires", name="admin.partenaires.index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $partenaires = $this->repo->findAll();

        return $this->render('admin/partenaires/index.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }

    /**================================================================================== */

    /**
     * Create partenaires.
     *
     * @Route("/admin/partenaires/create", name="admin.partenaires.new")
     *
     * @return void
     */
    public function new(Request $request)
    {
        $partenaire = new Partenaires();

        $form = $this->createForm(PartenairesType::class, $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($partenaire);
            $this->em->flush();
            $this->addFlash('success', 'Partenaire créé avec succès');

            return $this->redirectToRoute('admin.partenaires.index');
        }

        return $this->render('admin/partenaires/new.html.twig', [
            'partenaire' => $partenaire,
            'form' => $form->createView(),
        ]);
    }

    /**================================================================================== */

    /**
     * Edit partenaire.
     *
     * @Route("/admin/partenaires/{id}", name="admin.partenaires.edit", methods="GET|POST")
     *
     * @return void
     */
    public function edit(Request $request, Partenaires $partenaire)
    {
        $form = $this->createForm(PartenairesType::class, $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Partenaire modifié avec succès !');

            return $this->redirectToRoute('admin.partenaires.index');
        }

        return $this->render('admin/partenaires/edit.html.twig', [
            'partenaire' => $partenaire,
            'form' => $form->createView(),
        ]);
    }

    /**================================================================================== */

    /**
     * Delete partenaires.
     *
     * @Route("/admin/partenaires/{id}", name="admin.partenaires.delete", methods="DELETE")
     *
     * @return void
     */
    public function delete(Partenaires $partenaire, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$partenaire->getId(), $request->get('_token'))) {
            $this->em->remove($partenaire);
            $this->em->flush();
            $this->addFlash('success', 'Partenaire supprimé avec succès !');
        }

        return $this->redirectToRoute('admin.partenaires.index');
    }
}
