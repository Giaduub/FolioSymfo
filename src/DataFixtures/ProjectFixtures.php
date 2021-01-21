<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Project;

class ProjectFixtures extends Fixture
{
public function load(ObjectManager $manager)
{
// $product = new Product();
// $manager->persist($product);
for($i = 1; $i <= 10; $i++){
$project = new Project();
$project->setTitle("Project n°$i");
$project->setDescription("<p>Description du Projet n°$i</p>");
$project->setImage("https://picsum.photos/600");
$project->setGithub("Lien github du projet n°$i");
$project->setWeblink("Weblink du projet n°$i");

$manager->persist($project);
}

$manager->flush();
}
}