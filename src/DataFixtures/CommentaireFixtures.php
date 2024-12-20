<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Publication;
use App\Entity\Commentaire;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CommentaireFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = $this->getReference('regular_user', User::class);
        $publication = $this->getReference('publication_1', Publication::class);

        for ($i = 1; $i <= 2; $i++) {
            $commentaire = new Commentaire();
            $commentaire->setContent("Commentaire $i sur la publication.");
            $commentaire->setCreatedAt(new \DateTimeImmutable());
            $commentaire->setAuthor($user);
            $commentaire->setPublication($publication);

            $manager->persist($commentaire);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            PublicationFixtures::class,
        ];
    }
}