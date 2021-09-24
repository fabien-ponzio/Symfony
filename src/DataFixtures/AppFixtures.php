<?php

namespace App\DataFixtures;
use App\Entity\Post; 
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory; 

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
    
    $faker = Factory::create('fr_FR');
    for ($i=0; $i < 10 ; $i++) { 
        $post = new Post();
        $post->setTitle("Titre $i")
            ->setContent($faker->sentence($nbWords =2, $variableNbWords = true))
            ->setAuthor($faker->name($nbWords =10, $variableNbWords = true))
            ->setCreatedAt($faker->dateTimeBetween('-6 months'));

        $manager->persist($post);
    }
        $manager->flush();
    }
}
