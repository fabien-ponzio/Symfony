<?php

namespace App\Controller;

use App\Entity\Post; 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllaController extends AbstractController
{
    /**
     * @Route("/controlla", name="controlla")
     */
    public function index(): Response
    {
        $post = new Post();
        return $this->render('controlla/index.html.twig', [
            'controller_name' => 'ControllaController',
            'post' => $post
        ]);
    }
}
