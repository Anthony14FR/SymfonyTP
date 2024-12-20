<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tagNames = ['Symfony', 'PHP', 'Backend'];

        foreach ($tagNames as $name) {
            $tag = new Tag();
            $tag->setName($name);

            $manager->persist($tag);
        }

        $manager->flush();
    }
}
