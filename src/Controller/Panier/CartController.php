<?php

namespace App\Controller\Panier;

use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * Index.
     *
     * @Route("/boutique/panier", name="cart.index")
     *
     * @return void
     */
    public function index(CartService $cartService)
    {
        return $this->render('cart/index.html.twig', [
            'items' => $cartService->getFullCart(),
            'total' => $cartService->getTotal(),
        ]);
    }

    /**
     * Add to product.
     *
     * @Route("/boutique/panier/add/{id}", name="cart.add")
     *
     * @param [type] $id
     *
     * @return void
     */
    public function add($id, CartService $cartService)
    {
        $cartService->add($id);

        return $this->redirectToRoute('cart.index');
    }

    /**
     * Remove to product.
     *
     * @Route("/boutique/panier/remove/{id}", name="cart.remove")
     *
     * @param [type] $id
     *
     * @return void
     */
    public function remove($id, CartService $cartService)
    {
        $cartService->remove($id);

        return $this->redirectToRoute('cart.index');
    }
}
