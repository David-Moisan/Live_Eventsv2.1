<?php

namespace App\Controller\Admin;

use App\Entity\CategoriePartenaires;
use App\Form\CategoriePartenairesType;
use App\Repository\CategoriePartenairesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoriePartenairesController extends AbstractController
{
    private $em;
    private $repo;

    public function __construct(CategoriePartenairesRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /**================================================================================== */

    /**
     * Index categorie partenaires.
     *
     * @Route("/admin/categories", name="admin.categories.index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $categories = $this->repo->findAll();

        return $this->render('admin/categories/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**================================================================================== */

    /**
     * Create categories de partenaires.
     *
     * @Route("/admin/categories/create", name="admin.categories.new")
     *
     * @return void
     */
    public function new(Request $request)
    {
        $categorie = new CategoriePartenaires();

        $form = $this->createForm(CategoriePartenairesType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($categorie);
            $this->em->flush();
            $this->addFlash('success', 'La Catégorie a été créé avec succès');

            return $this->redirectToRoute('admin.categories.index');
        }

        return $this->render('admin/categories/new.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**================================================================================== */

    /**
     * Edit Categorie des partenaires.
     *
     * @Route("/admin/categories/{id}", name="admin.categories.edit", methods="GET|POST")
     *
     * @return void
     */
    public function edit(Request $request, CategoriePartenaires $categorie)
    {
        $form = $this->createForm(CategoriePartenairesType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'La catégorie a été modifié avec succès !');

            return $this->redirectToRoute('admin.categories.index');
        }

        return $this->render('admin/categories/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**================================================================================== */

    /**
     * Delete Catégorie.
     *
     * @Route("/admin/categories/{id}", name="admin.categories.delete", methods="DELETE")
     *
     * @return void
     */
    public function delete(CategoriePartenaires $categorie, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->get('_token'))) {
            $this->em->remove($categorie);
            $this->em->flush();
            $this->addFlash('success', 'La catégorie a été supprimé avec succès !');
        }

        return $this->redirectToRoute('admin.categories.index');
    }
}
