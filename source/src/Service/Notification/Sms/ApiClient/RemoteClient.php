<?php

namespace App\Service\Notification\Sms\ApiClient;

use App\Enum\SmsTransportEnum;

class RemoteClient implements ApiClientInterface
{
    private const TYPE = SmsTransportEnum::Remote;

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
}
