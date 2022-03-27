<?php

namespace App\Service\Notification\Sms\ApiClient;

use App\Enum\SmsTransportEnum;

interface ApiClientInterface
{
    public function sendSms(string $phoneNumber, string $message): void;

    public function getType(): SmsTransportEnum;
}
