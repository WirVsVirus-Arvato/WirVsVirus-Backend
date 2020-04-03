<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClusterController extends AbstractController
{
    /**
     * @Route("/cluster", name="cluster")
     */
    public function index()
    {
        return $this->render('cluster/index.html.twig', [
            'controller_name' => 'ClusterController',
            'menu_active' => 'cluster'
        ]);
    }
}
