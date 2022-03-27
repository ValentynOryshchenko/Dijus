<?php

namespace App\Service\Notification\Sms\ApiClient;

use App\Enum\SmsTransportEnum;

class LocalClient3 implements ApiClientLocalInterface
{
    private const TYPE = SmsTransportEnum::Local;
    private const COUNTRY_CODE = 'PL';

    public function sendSms(string $phoneNumber, string $message): void
    {
        //TODO: send sms code

        dump($phoneNumber);
        dump($message);
        dump(self::class);
        die;
    }

    public function getType(): SmsTransportEnum
    {
        return self::TYPE;
    }

    public function getCountryCode(): string
    {
        return self::COUNTRY_CODE;
    }
}
