<?php

declare(strict_types=1);

namespace App\Tests\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


final class DeleteUserTest extends WebTestCase
{
    public function test_delete_should_return_success(): void
    {
        $client = static::createClient();

        $client->request(method: 'GET', uri: '/users');
        $firstUser = json_decode($client->getResponse()->getContent())[0]->id;

        $client->request(method: 'DELETE', uri: '/users/'.$firstUser);
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_ACCEPTED, $statusCode);
    }

    public function test_delete_should_return_not_found(): void
    {
        $client = static::createClient();

        $client->request(method: 'DELETE', uri: '/users/999');
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
