<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="index")
     */
    public function index(): Response
    {
        $repo= $this->getDoctrine()->getRepository(Article::Class);

        $articles = $repo->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        return $this->render('home/home.html.twig', [
            'title' => "Bienvenue ici les amis!",
            'age' => 1,
            'controller_name' => 'HomeController',
        ]);
    }
       
    /**
     * @Route("/home/{id}", name="blog_show")
     */
    public function show($id){
         $repo = $this->getDoctrine()->getRepository(Article::class);

         $article = $repo->find($id);
        return $this->render('home/show.html.twig', [
            'article' =>$article,
        ]);
    }
}
