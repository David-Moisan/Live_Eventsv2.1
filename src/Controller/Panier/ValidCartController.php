<?php

namespace App\Controller\Panier;

use App\Service\Cart\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ValidCartController extends AbstractController
{
    /**
     * @Route("/boutique/panier/achat", name="valid.index")
     *
     * @return Response
     */
    public function index(CartService $cartService): Response
    {
        return $this->render('valid/index.html.twig', [
            'total' => $cartService->getTotal(),
            'items' => $cartService->getFullCart(),
        ]);
    }
}
