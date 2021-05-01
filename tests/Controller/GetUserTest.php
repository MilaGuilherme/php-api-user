<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class GetUserActionTest extends TestCase
{
    
    public function test_get_user_should_return_200(): void
    {
        $faker = Factory::create();

        $user = new User();
        $user->setFirstName($faker->firstName());
        $user->setLastName($faker->lastName());
        $user->setEmail($faker->email());
        $this->em->persist($user);
        $this->em->flush();

        $this->client->request(method: 'GET', uri: '/users/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

    public function test_get_user_should_return_404(): void
    {
        $this->client->request(method: 'GET', uri: '/users/999');
        $statusCode = $this->client->getResponse()->getStatusCode();
        
        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
