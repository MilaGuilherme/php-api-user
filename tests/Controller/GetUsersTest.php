<?php

namespace App\Tests\Controller;

use App\Entity\User;
use App\Tests\TestCase;
use Faker\Factory;
use Symfony\Component\HttpFoundation\Response;

class GetUsersTest extends TestCase
{
    public function test_get_users_should_return_200(): void
    {
        $this->client->request(method: 'GET', uri: '/users');
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

}
