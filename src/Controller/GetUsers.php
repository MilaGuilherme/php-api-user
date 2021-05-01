<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;

class GetUsers
{
    public function __construct(private EntityManagerInterface $entityManager, private SerializerInterface $serializer)
    {
    }

    #[Route("/users", methods: ["GET"])]
    public function __invoke(): Response
    {
        $repository = $this->entityManager->getRepository(User::class);
        $users = $repository->findAll();

        $response = $this->serializer->serialize($users, 'json', [
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);

        if(count($users)>0){
            return JsonResponse::fromJsonString($response);
        }
        else{
        return new JsonResponse(
            Response::HTTP_NO_CONTENT
        );
        }

    }
}
