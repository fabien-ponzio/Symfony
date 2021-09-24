<?php

namespace App\Controller;

use App\Entity\Post; 
use App\Entity\Comment;
use App\Form\CommentType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; 
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ControllaController extends AbstractController
{
    /**
     * @Route("/", name="controlla")
     */
    public function index(): Response
    {
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('controlla/index.html.twig', [
            'controller_name' => 'ControllaController',
            'posts' => $posts
        ]);
    }
    /**
     * @Route("/post/{id}", name="show_post")
     */

    public function show(Post $post, Request $request, EntityManagerInterface $em){

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $comment->setCreatedAt(new DateTime('now'));
            $comment->setPost($post);
            $em->persist($comment);
            $em->flush();
            // return $this->redirectToRoute()
        }



        return $this->render('controlla/post.html.twig', [
            'controller_name' => 'ControllaController',
            'form' => $form->createView(),
            'post' => $post
        ]);
    }
}

