<?php

namespace App\Service\Notification\Sms;

use App\Entity\SmsMessage;
use App\Enum\SmsCodeEnum;
use App\Repository\SmsMessageRepository;

class MessageManager
{
    private SmsMessageRepository $smsMessageRepository;

    public function __construct(SmsMessageRepository $smsMessageRepository)
    {
        $this->smsMessageRepository = $smsMessageRepository;
    }

    public function getMessageByCode(SmsCodeEnum $smsCode): SmsMessage
    {
        return $this->smsMessageRepository->getMessageByCode($smsCode);
    }

    public function prepareMessageText(SmsMessage $message, array $vars): string
    {
        $message = $message->getMessage();

        foreach ($vars as $varName => $varValue) {
            $message = str_replace('{' . $varName . '}', $varValue, $message);
        }

        return $message;
    }
}
