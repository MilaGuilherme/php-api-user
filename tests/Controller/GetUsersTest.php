<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class GetUsersTest extends WebTestCase
{
    public function test_get_users_should_return_200(): void
    {
        $client = static::createClient();

        $client->request(method: 'GET', uri: '/users');
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

}
