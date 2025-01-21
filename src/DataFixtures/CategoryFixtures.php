<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public static function getData(): array
    {
        return [
            ['name' => 'Intérieur', 'color' => '#22333B'],
            ['name' => 'Familial', 'color' => '#549414'],
            ['name' => 'Sensation', 'color' => '#8F2874'],
            ['name' => 'Bois', 'color' => '#6E4122'],
            ['name' => 'Inversion', 'color' => '#1C36BA'],
            ['name' => 'Mega Coaster', 'color' => '#9B3E36'],
            ['name' => 'Aquatique', 'color' => '#247195'],
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getData() as $data) {
            $category = new Category();
            $category->setName($data['name']);
            $category->setColor($data['color']);
            $this->addReference($data['name'], $category);

            $manager->persist($category);
        }

        $manager->flush();
    }
}
