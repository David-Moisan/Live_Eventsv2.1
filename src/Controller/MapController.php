<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MapController extends AbstractController
{
    /**
     * Undocumented function.
     *
     *@Route("/map", name="map")
     *
     * @return Response
     */
    public function mapIndex(): Response
    {
        return $this->render('/pages/map.html.twig');
    }
}
