<?php

namespace App\DataFixtures;

use App\Entity\Park;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ParkFixtures extends Fixture
{
    public static function getData(): array
    {
        return [
            [
                'name' => 'Parc Astérix',
                'country' => 'FR',
                'openingYear' => 1989,
            ],
            [
                'name' => 'Europa Park',
                'country' => 'DE',
                'openingYear' => 1975,
            ],
            [
                'name' => 'Disneyland Paris',
                'country' => 'FR',
                'openingYear' => 1992,
            ],
            [
                'name' => 'PortAventura',
                'country' => 'ES',
                'openingYear' => 1995,
            ],
            [
                'name' => 'Phantasialand',
                'country' => 'DE',
                'openingYear' => 1967,
            ],
            [
                'name' => 'Alton Towers',
                'country' => 'GB',
                'openingYear' => 1980,
            ],
            [
                'name' => 'Thorpe Park',
                'country' => 'GB',
                'openingYear' => 1979,
            ],
            [
                'name' => 'Efteling',
                'country' => 'NL',
                'openingYear' => 1952,
            ],
            [
                'name' => 'Tivoli Gardens',
                'country' => 'DK',
                'openingYear' => 1843,
            ],
            [
                'name' => 'Liseberg',
                'country' => 'SE',
                'openingYear' => 1923,
            ],
            [
                'name' => 'Fraispertuis City',
                'country' => 'FR',
                'openingYear' => 1966,
            ],
        ];
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::getData() as $data) {
            $park = new Park();
            $park->setName($data['name']);
            $park->setCountry($data['country']);
            $park->setOpeningYear($data['openingYear']);
            $this->addReference($data['name'], $park);

            $manager->persist($park);
        }

        $manager->flush();
    }
}
