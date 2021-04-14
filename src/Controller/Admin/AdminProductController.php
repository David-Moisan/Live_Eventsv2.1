<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    private $repo;

    public function __construct(ProductRepository $repo)
    {
        $this->repo = $repo;
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
     * @Route("/admin/{id}", name="admin.product.edit")
     *
     * @return void
     */
    public function edit(Product $product)
    {
        $form = $this->createForm(ProductType::class, $product);

        return $this->render('admin/product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /* ============================================================== */
}
