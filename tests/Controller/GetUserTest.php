<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
class GetUserTest extends WebTestCase
{
    
    public function test_get_user_should_return_200(): void
    {
        $client = static::createClient();
        
        $client->request(method: 'GET', uri: '/users');
        $firstUser = json_decode($client->getResponse()->getContent())[0]->id || 3;

        $client ->request(method: 'GET', uri: '/users/'.$firstUser);
        $statusCode = $client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_OK, $statusCode);
    }

    public function test_get_user_should_return_404(): void
    {
        $client = static::createClient();

        $client->request(method: 'GET', uri: '/users/999');
        $statusCode = $client->getResponse()->getStatusCode();
        
        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
