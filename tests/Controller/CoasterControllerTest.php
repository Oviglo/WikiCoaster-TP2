<?php

namespace App\Tests\Controller;

use App\Repository\CoasterRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CoasterControllerTest extends WebTestCase
{
    // Pour que PHPUnit fasse ce test, la fonction doit être préfixée par "test"
    public function testIndex()
    {
        $client = static::createClient();

        // Charge la page de la liste des coasters
        $client->request('GET', '/coaster/');

        // Test si la page n'a pas d'erreur
        $this->assertResponseIsSuccessful();
        // Test le contenu du h1
        $this->assertSelectorTextContains('h1', 'Liste des coasters');
    }

    public function testAdd()
    {
        $client = static::createClient();

        $userRepository = self::getContainer()->get(UserRepository::class);
        $adminUser = $userRepository->findOneBy(['username' => 'admin']); // Récupére l'user admin dans la db
        $client->loginUser($adminUser);

        $client->request('GET', '/coaster/add');

        $this->assertResponseIsSuccessful();

        // Envoi le formulaire avec des données
        $client->submitForm('Ajouter', [
            'coaster[name]' => 'Coaster test',
            'coaster[maxSpeed]' => 120,
            'coaster[maxHeight]' => 85,
            'coaster[length]' => 1200, 
        ]);

        // Test s'il y a bien une redirection (pas d'erreur dans le form)
        $this->assertResponseRedirects(); 

        // Charger la page de redirection
        // $client->followRedirect();

        $coasterRepository = self::getContainer()->get(CoasterRepository::class);
        $newCoaster = $coasterRepository->findOneBy(['name' => 'Coaster test']);

        $this->assertNotNull($newCoaster);
    }
}