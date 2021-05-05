<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    private $repo;
    private $em;

    public function __construct(ProductRepository $repo, EntityManagerInterface $em)
    {
        $this->repo = $repo;

        $this->em = $em;
    }

    /**
     * Index des produits.
     *
     * @Route("/boutique/", name="product.index")
     *
     * @return Response
     */
    public function index(): Response
    {
        $products = $this->repo->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * Show des produits.
     *
     * @Route("/boutique/{slug} - {id}", name="product.show", requirements={"slug": "[a-z0-9\-]*"})
     *
     * @return Response
     */
    public function show(Product $product, string $slug): Response
    {
        if ($product->getSlug() !== $slug) {
            return $this->redirectToRoute('product.show', [
                'id' => $product->getId(),
                'slug' => $product->getSlug(),
            ], 301);
        }

        return $this->render('/product/show.html.twig', [
            'product' => $product,
        ]);
    }
}
