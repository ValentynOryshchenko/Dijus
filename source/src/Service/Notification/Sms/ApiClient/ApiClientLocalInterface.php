<?php

namespace App\Service\Notification\Sms\ApiClient;

interface ApiClientLocalInterface extends ApiClientInterface
{
    public function getCountryCode(): string;
}
