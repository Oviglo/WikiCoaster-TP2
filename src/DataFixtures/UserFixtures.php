<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public static function getData(): array
    {
        return [
            [
                'username' => 'admin',
                'password' => 'admin',
                'email' => 'admin@example.com',
                'roles' => ['ROLE_ADMIN'],
            ],
            [
                'username' => 'user',
                'password' => 'user',
                'email' => 'user@example.com',
                'roles' => [],
            ],
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getData() as $data) {
            $user = new User();
            $user->setUsername($data['username']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $data['password']));
            $user->setRoles($data['roles']);
            $user->setEmail($data['email']);

            $manager->persist($user);
        }

        $manager->flush();
    }
}
