<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
use App\Entity\Project;
use App\Repository\ArticleRepository;
use App\Repository\ProjectRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="index")
     */
    public function index(ArticleRepository $repo): Response
    {

        $articles = $repo->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles,
        ]);
    }

    /**
     * @Route("/projets", name="projets")
     */
    public function projets(ProjectRepository $repo): Response
    {

        $projects = $repo->findAll();
        return $this->render('home/projets.html.twig', [
            'controller_name' => 'HomeController',
            'projects' => $projects,
        ]);
    }

    /**
     * @Route("/home/new", name="projet_create")
     */
    public function create(Request $request, EntityManagerInterface $manager) {
        

        if($request->request->count() > 0){
            $project = new Project();
            $project->setTitle($request->request->get('Title'))
                    ->setDescription($request->request->get('Description'))
                    ->setImage($request->request->get('Image'))
                    ->setGithub($request->request->get('Github'))
                    ->setWeblink($request->request->get('Weblink'));

                    $manager->persist($project);
                    $manager->flush();
            
        }
        return $this->render('home/create.html.twig');
    }     


    /**
     * @Route("/projet/{id}", name="projet_show")
     */
    public function showProject(Project $project){

   
       return $this->render('home/showprojet.html.twig', [
           'project' => $project,
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
    public function show(Article $article){
        
        return $this->render('home/show.html.twig', [
            'article' => $article,
        ]);
    }
     
    
}
