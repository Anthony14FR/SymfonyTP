<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Publication;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PublicationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = $this->getReference('regular_user', User::class);

        for ($i = 1; $i <= 3; $i++) {
            $publication = new Publication();
            $publication->setTitle("Publication $i");
            $publication->setContent("Contenu de la publication $i.");
            $publication->setCreatedAt(new \DateTimeImmutable());
            $publication->setAuthor($user);

            $manager->persist($publication);
            $this->addReference('publication_' . $i, $publication);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}