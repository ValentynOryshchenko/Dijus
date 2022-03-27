<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $customer = new Customer();

        $customer->setName('Test customer');
        $customer->setEmail('nan@to.net.ua');
        $customer->setPassword('password');
        $customer->setPhone('0976508678');
        $customer->setRoles('ROLE_USER');
        $customer->setCountry('UA');

        $manager->persist($customer);
        $manager->flush();
    }
}
