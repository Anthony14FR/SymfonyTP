<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Publication;
use App\Entity\Reaction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ReactionFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $user = $this->getReference('regular_user', User::class);
        $publication = $this->getReference('publication_1', Publication::class);

        $reactionTypes = ['like', 'dislike'];
        foreach ($reactionTypes as $type) {
            $reaction = new Reaction();
            $reaction->setType($type);
            $reaction->setCreatedAt(new \DateTimeImmutable());
            $reaction->setAuthor($user);
            $reaction->setPublication($publication);

            $manager->persist($reaction);
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