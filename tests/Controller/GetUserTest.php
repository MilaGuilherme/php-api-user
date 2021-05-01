<?php

namespace App\Tests\Controller;

use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

class GetUserTest extends TestCase
{
    
    public function test_get_user_should_return_200(): void
    {
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
