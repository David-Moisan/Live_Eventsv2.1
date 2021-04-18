<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    private $repo;
    private $em;

    public function __construct(ProductRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;
        $this->em = $em;
    }

    /* ============================================================== */

    /**
     * Index.
     *
     * @Route("/admin", name="admin.product.index")
     *
     * @return void
     */
    public function index()
    {
        $products = $this->repo->findAll();

        return $this->render('admin/product/index.html.twig', compact('products'));
    }

    /* ============================================================== */

    /**
     * Edit.
     *
     * @Route("/admin/{id}", name="admin.product.edit", methods="GET|POST")
     *
     * @return void
     */
    public function edit(Product $product, Request $request)
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($product);
            $this->em->flush();
            $this->addFlash('success', 'Produit modifié avec succès');

            return $this->redirectToRoute('admin.product.index');
        }

        return $this->render('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /* ============================================================== */

    /**
     * Create new product.
     *
     * @Route("/admin/produit/creation", name="admin.product.new")
     *
     * @return void
     */
    public function new(Request $request)
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($product);
            $this->em->flush();
            $this->addFlash('success', 'Produit créé avec succès');

            return $this->redirectToRoute('admin.product.index');
        }

        return $this->render('admin/product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /* ============================================================== */

    /**
     * Delete a product.
     *
     * @Route("/admin/produit/{id}", name="admin.product.delete", methods="DELETE")
     *
     * @return void
     */
    public function delete(Product $product, Request $request)
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->get('_token'))) {
            $this->em->remove($product);
            $this->em->flush();
            $this->addFlash('success', 'Produit supprimé avec succès');
        }

        return $this->redirectToRoute('admin.product.index');
    }
}
