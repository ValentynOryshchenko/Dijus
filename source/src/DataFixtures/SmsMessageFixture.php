<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Entity\SmsMessage;
use App\Enum\SmsCodeEnum;
use App\Enum\SmsTransportEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SmsMessageFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $message = new SmsMessage();

        $message->setCode(SmsCodeEnum::Remind);
        $message->setMessage('Привіт {name}. Твій новий пароль {password}');
        $message->setTransport(SmsTransportEnum::Local);

        $manager->persist($message);

        $message = new SmsMessage();

        $message->setCode(SmsCodeEnum::Register);
        $message->setMessage('Привіт {name}');
        $message->setTransport(SmsTransportEnum::Remote);

        $manager->persist($message);

        $manager->flush();
    }
}
