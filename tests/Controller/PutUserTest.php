<?php

namespace App\Tests\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Faker\Factory;
final class PutUserTest extends WebTestCase
{
    public function test_put_should_return_success(): void
    {
        $client = static::createClient();

        $faker = Factory::create();
        
        $client->request(method: 'GET', uri: '/users');
        $firstUser = json_decode($client->getResponse()->getContent())[0]->id;

        $client->request(method: 'PUT', uri: '/users/'.$firstUser,content:json_encode([
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
            'email' => $faker->email(),
        ]));
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_ACCEPTED, $statusCode);
    }
}
