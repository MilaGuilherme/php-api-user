<?php

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use Faker\Factory;
final class PostUserTest extends WebTestCase
{
    public function test_post_should_return_success(): void
    {
        $client = static::createClient();

        $faker = Factory::create();

        $client->request(method: 'POST', uri: '/users',content:
        json_encode([
            'firstName' => $faker->firstName(),
            'lastName' => $faker->lastName(),
            'email' => $faker->email(),
        ]));
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_CREATED, $statusCode);
    }
}
