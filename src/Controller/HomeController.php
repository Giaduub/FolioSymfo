<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="index")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
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
     * @Route("/home/article/12", name="blog_show")
     */
    public function show(){
        return $this->render('home/show.html.twig');
    }
}
