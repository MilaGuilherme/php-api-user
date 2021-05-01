<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Phone;
use App\Entity\Address;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 50; $i++) {
            $user = new User();
            $phone = new Phone();
            $address = new Address();
            $address->setState("MG");
            $address->setCity($faker->firstName());
            $address->setNeighbourhood($faker->city());
            $address->setStreet($faker->streetName());
            $address->setNumber($faker->buildingNumber());
            $address->setComplement($faker->secondaryAddress());
            $phone->setDDD(31);
            $phone->setPhoneNumber("9999-9999");
            $user->setAddress($address);
            $user->setFirstName($faker->firstName());
            $user->setLastName($faker->lastName());
            $user->setEmail($faker->email());
            $user->addPhone($phone);
            $manager->persist($user);
        }

        $manager->flush();
    }
}