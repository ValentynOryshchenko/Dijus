<?php

namespace App\Service\Notification\Sms;

use App\Enum\SmsTransportEnum;
use App\Service\Notification\Sms\ApiClient\ApiClientInterface;
use App\Service\Notification\Sms\ApiClient\ApiClientLocalInterface;
use App\Service\Notification\Sms\Exception\TransportNotFoundException;

class TransportManager
{
    private iterable $apiClientCollection;

    public function __construct(iterable $apiClientCollection)
    {
        $this->apiClientCollection = $apiClientCollection;
    }

    /**
     * @throws TransportNotFoundException
     */
    public function send(
        SmsTransportEnum $smsTransportType,
        string $countryCode,
        string $phoneNumber,
        string $message
    ): void
    {
        $this->getClientByTypeAndLocale($smsTransportType, $countryCode)
            ->sendSms($phoneNumber, $message);
    }

    /**
     * @throws TransportNotFoundException
     */
    protected function getClientByTypeAndLocale(
        SmsTransportEnum $smsTransportType,
        string $countryCode
    ): ApiClientInterface {

        /* @var ApiClientInterface $client */
        foreach ($this->apiClientCollection as $client) {

            if ($smsTransportType == SmsTransportEnum::Local && $client->getType() == SmsTransportEnum::Local) {
                /* @var ApiClientLocalInterface $client */
                if ($client->getCountryCode() == $countryCode) {
                    return $client;
                }
            }

            if ($smsTransportType == SmsTransportEnum::Remote && $client->getType() == SmsTransportEnum::Remote) {
                return $client;
            }
        }

        throw new TransportNotFoundException("Transport type {$smsTransportType} 
            by country {$countryCode} not found");
    }
}
