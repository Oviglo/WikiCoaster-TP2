<?php

namespace App\Tests\Controller;

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
    }
}