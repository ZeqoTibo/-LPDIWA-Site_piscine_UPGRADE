<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail("user@gmail.com");
        $user->setUsername("User");
        $pass = "userpass";
        $password = $this->encoder->hashPassword($user, $pass);
        $user->setPassword($password);

        $manager->persist($user);
        $manager->flush();
    }
}
