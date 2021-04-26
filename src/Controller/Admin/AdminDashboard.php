<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboard extends AbstractController
{
    /**
     * Dashboard.
     *
     * @Route("/admin", name="admin.dash.index")
     *
     * @return void
     */
    public function index()
    {
        return $this->render('/admin/dashboard/index.html.twig');
    }
}
