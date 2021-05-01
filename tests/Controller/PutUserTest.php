<?php

namespace App\Tests\Controller;
use App\Entity\User;
use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;
use Faker\Factory;

final class PutUserTest extends TestCase
{
    public function test_put_should_return_success(): void
    {
        $faker = Factory::create();

        $user = new User();
        $user->setFirstName($faker->firstName());
        $user->setLastName($faker->lastName());
        $user->setEmail($faker->email());

        $this->client->request(method: 'PUT', uri: '/users/1',content:json_encode($user));
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_ACCEPTED, $statusCode);
    }
}
