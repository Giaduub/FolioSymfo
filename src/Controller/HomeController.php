<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ArticleRepository;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
     * @Route("/projet/new", name="projet_create")
     * @Route("/projet/{id}/edit", name="projet_edit")
     */
    public function form(Project $project = null, Request $request, EntityManagerInterface $manager) {
        

        if(!$project) {
            $project = new Project();
        }

        $form = $this->createFormBuilder($project)
                     ->add('Title')
                     ->add('Description')
                     ->add('Image')
                     ->add('Github')
                     ->add('Weblink')
                     ->getForm();
 
                    $form->handleRequest($request);

                    if($form->isSubmitted() && $form->isValid()){
                        $manager->persist($project);
                        $manager->flush();

                        return $this->redirectToRoute('projet_show', ['id' => $project->getId()]);
                    }

  return $this->render('home/create.html.twig', [
            'formProject' => $form->createView()
        ]);
//         $form = $this->createForm(ProjectType::class, $project);
// $form->handleRequest($request);
// if($form->isSubmitted() && $form->isValid()){
// $manager->persist($project);
// $manager->flush();
// return $this->redirectToRoute('projets');
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
