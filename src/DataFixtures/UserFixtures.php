<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('user@orus.com');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstName('User');
        $user->setLastName('Orus');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'user'));

        $manager->persist($user);
        $this->addReference('regular_user', $user);


        $admin = new User();
        $admin->setEmail('admin@orus.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstName('Admin');
        $admin->setLastName('Orus');
        $admin->setPassword($this->passwordHasher->hashPassword($admin, 'admin'));

        $manager->persist($admin);
        $this->addReference('admin_user', $admin);

        $manager->flush();
    }
}