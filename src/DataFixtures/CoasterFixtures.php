<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Coaster;
use App\Entity\Park;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CoasterFixtures extends Fixture implements DependentFixtureInterface
{
    public static function getData(): array
    {
        return [
            [
                'park' => 'Parc Astérix',
                'name' => 'Tonnerre de Zeus',
                'maxSpeed' => 83,
                'maxHeight' => 30,
                'length' => 1230,
                'operating' => true,
                'categories' => ['Bois', 'Sensation'],
                'imageFileName' => 'tonnerre-de-zeus.jpg',
                'published' => true,
            ],
            [
                'park' => 'Parc Astérix',
                'name' => 'OzIris',
                'maxSpeed' => 90,
                'maxHeight' => 40,
                'length' => 1050,
                'operating' => true,
                'categories' => ['Inversion', 'Sensation'],
                'published' => true,
                'imageFileName' => 'oziris.jpg',
            ],
            [
                'park' => 'Europa Park',
                'name' => 'Silver Star',
                'maxSpeed' => 130,
                'maxHeight' => 73,
                'length' => 1620,
                'operating' => true,
                'categories' => ['Mega Coaster', 'Sensation'],
                'published' => true,
                'imageFileName' => 'silver-star.jpg',
            ],
            [
                'park' => 'Europa Park',
                'name' => 'Blue Fire',
                'maxSpeed' => 100,
                'maxHeight' => 38,
                'length' => 1050,
                'operating' => true,
                'categories' => ['Mega Coaster', 'Sensation'],
                'published' => true,
                'imageFileName' => 'blue-fire.jpg',
            ],
            [
                'park' => 'Europa Park',
                'name' => 'Wodan',
                'maxSpeed' => 100,
                'maxHeight' => 40,
                'length' => 1050,
                'operating' => true,
                'categories' => ['Bois', 'Sensation'],
                'published' => true,
                'imageFileName' => 'wodan.jpg',
            ],
            [
                'park' => 'Europa Park',
                'name' => 'Arthur',
                'maxSpeed' => 50,
                'maxHeight' => 15,
                'length' => 550,
                'operating' => true,
                'categories' => ['Familial', 'Intérieur'],
                'published' => true,
                'imageFileName' => 'arthur.jpg',
            ],
            [
                'park' => 'Europa Park',
                'name' => 'Poseidon',
                'maxSpeed' => 80,
                'maxHeight' => 20,
                'length' => 850,
                'operating' => true,
                'categories' => ['Aquatique', 'Familial'],
                'published' => true,
                'imageFileName' => 'poseidon.jpg',
            ],
            [
                'park' => 'Disneyland Paris',
                'name' => 'Rock\'n\'Roller Coaster',
                'maxSpeed' => 92,
                'maxHeight' => 35,
                'length' => 1200,
                'operating' => false,
                'categories' => ['Intérieur', 'Sensation', 'Inversion'],
                'published' => true,
                'imageFileName' => 'rock-n-roller-coaster.jpg',
            ],

            [
                'park' => 'Disneyland Paris',
                'name' => 'Space Mountain',
                'maxSpeed' => 72,
                'maxHeight' => 32,
                'length' => 2000,
                'operating' => true,
                'categories' => ['Intérieur', 'Sensation', 'Inversion'],
                'published' => true,
                'imageFileName' => 'space-mountain.jpg',
            ],
            [
                'park' => 'Disneyland Paris',
                'name' => 'Big Thunder Mountain',
                'maxSpeed' => 60,
                'maxHeight' => 25,
                'length' => 1500,
                'operating' => true,
                'categories' => ['Bois', 'Sensation'],
                'published' => true,
                'imageFileName' => 'big-thunder-mountain.jpg',
            ],
            [
                'park' => 'PortAventura',
                'name' => 'Shambhala',
                'maxSpeed' => 134,
                'maxHeight' => 76,
                'length' => 1564,
                'operating' => true,
                'categories' => ['Mega Coaster', 'Sensation'],
                'published' => true,
                'imageFileName' => 'shambhala.jpg',
            ],
            [
                'park' => 'PortAventura',
                'name' => 'Dragon Khan',
                'maxSpeed' => 110,
                'maxHeight' => 45,
                'length' => 1273,
                'operating' => true,
                'categories' => ['Sensation', 'Inversion'],
                'published' => true,
                'imageFileName' => 'dragon-khan.jpg',
            ],
            [
                'park' => 'Phantasialand',
                'name' => 'Taron',
                'maxSpeed' => 117,
                'maxHeight' => 30,
                'length' => 1349,
                'operating' => true,
                'categories' => ['Mega Coaster', 'Sensation'],
                'published' => true,
                'imageFileName' => 'taron.jpg',
            ],
            [
                'park' => 'Phantasialand',
                'name' => 'Black Mamba',
                'maxSpeed' => 80,
                'maxHeight' => 26,
                'length' => 770,
                'operating' => true,
                'categories' => ['Sensation', 'Inversion'],
                'published' => true,
                'imageFileName' => 'black-mamba.jpg',
            ],
            [
                'park' => 'Alton Towers',
                'name' => 'Oblivion',
                'maxSpeed' => 109,
                'maxHeight' => 54,
                'length' => 234,
                'operating' => true,
                'categories' => ['Sensation', 'Intérieur'],
                'published' => true,
                'imageFileName' => 'oblivion.jpg',
            ],
            [
                'park' => 'Alton Towers',
                'name' => 'The Smiler',
                'maxSpeed' => 85,
                'maxHeight' => 30,
                'length' => 361,
                'operating' => true,
                'categories' => ['Sensation', 'Inversion'],
                'published' => true,
                'imageFileName' => 'the-smiler.jpg',
            ],
            [
                'park' => 'Thorpe Park',
                'name' => 'Stealth',
                'maxSpeed' => 130,
                'maxHeight' => 62,
                'length' => 400,
                'operating' => true,
                'categories' => ['Sensation'],
                'published' => true,
                'imageFileName' => 'stealth.jpg',
            ],
            [
                'park' => 'Thorpe Park',
                'name' => 'Saw',
                'maxSpeed' => 85,
                'maxHeight' => 30,
                'length' => 775,
                'operating' => true,
                'categories' => ['Sensation', 'Intérieur'],
                'published' => true,
                'imageFileName' => 'saw.jpg',
            ],
            [
                'park' => 'Efteling',
                'name' => 'Baron 1898',
                'maxSpeed' => 90,
                'maxHeight' => 37,
                'length' => 501,
                'operating' => true,
                'categories' => ['Sensation', 'Intérieur'],
                'published' => true,
                'imageFileName' => 'baron-1898.jpg',
            ],
            [
                'park' => 'Efteling',
                'name' => 'Joris en de Draak',
                'maxSpeed' => 75,
                'maxHeight' => 25,
                'length' => 810,
                'operating' => true,
                'categories' => ['Bois', 'Sensation'],
                'published' => true,
                'imageFileName' => 'joris-en-de-draak.jpg',
            ],
            [
                'park' => 'Tivoli Gardens',
                'name' => 'Daemonen',
                'maxSpeed' => 77,
                'maxHeight' => 28,
                'length' => 564,
                'operating' => true,
                'categories' => ['Sensation', 'Inversion'],
                'published' => true,
                'imageFileName' => 'daemonen.jpg',
            ],
            [
                'park' => 'Tivoli Gardens',
                'name' => 'Rutschebanen',
                'maxSpeed' => 50,
                'maxHeight' => 13,
                'length' => 720,
                'operating' => true,
                'categories' => ['Bois', 'Familial'],
                'published' => true,
                'imageFileName' => 'rutschebanen.jpg',
            ],
            [
                'park' => 'Liseberg',
                'name' => 'Helix',
                'maxSpeed' => 100,
                'maxHeight' => 41,
                'length' => 1380,
                'operating' => true,
                'categories' => ['Sensation', 'Inversion'],
                'published' => true,
                'imageFileName' => 'helix.jpg',
            ],
            [
                'park' => 'Fraispertuis City',
                'name' => 'Timber Drop',
                'maxSpeed' => 113,
                'maxHeight' => 37,
                'length' => 450,
                'operating' => true,
                'categories' => ['Sensation', 'Inversion'],
                'published' => true,
                'imageFileName' => 'timber-drop.jpg',
            ],
            [
                'park' => 'Fraispertuis City',
                'name' => 'Grand Canyon',
                'maxSpeed' => 70,
                'maxHeight' => 20,
                'length' => 500,
                'operating' => true,
                'categories' => ['Familial'],
                'published' => true,
                'imageFileName' => 'grand-canyon.jpg',
            ],
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getData() as $data) {
            $coaster = new Coaster();
            $coaster->setName($data['name']);
            $coaster->setMaxSpeed($data['maxSpeed']);
            $coaster->setLength($data['length']);
            $coaster->setMaxHeight($data['maxHeight']);
            $coaster->setOperating($data['operating']);
            $coaster->setPark($this->getReference($data['park'], Park::class));
            $coaster->setPublished($data['published']);

            foreach ($data['categories'] as $category) {
                $coaster->addCategory($this->getReference($category, Category::class));
            }

            if (isset($data['imageFileName'])) {
                $coaster->setImageFileName($data['imageFileName']);
            }

            $manager->persist($coaster);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ParkFixtures::class,
            CategoryFixtures::class,
        ];
    }
}
