<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use App\Tests\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class DeleteUserTest extends TestCase
{
    public function test_delete_should_return_no_content(): void
    {

        $user = new User();
        $user->setFirstName($faker->firstName());
        $user->setLastName($faker->lastName());
        $user->setEmail($faker->email());
        $this->em->persist($user);
        $this->em->flush();

        $this->client->request(method: 'DELETE', uri: '/users/1');
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NO_CONTENT, $statusCode);
    }

    public function test_delete_should_return_not_found(): void
    {
        $this->client->request(method: 'DELETE', uri: '/users/999');
        $statusCode = $this->client->getResponse()->getStatusCode();

        $this->assertSame(Response::HTTP_NOT_FOUND, $statusCode);
    }
}
