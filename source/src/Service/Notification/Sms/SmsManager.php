<?php

namespace App\Service\Notification\Sms;

use App\Entity\Customer;
use App\Enum\SmsCodeEnum;

class SmsManager
{
    private MessageManager $messageManager;
    private TransportManager $transportManager;

    public function __construct(MessageManager $messageManager, TransportManager $transportManager)
    {
        $this->messageManager = $messageManager;
        $this->transportManager = $transportManager;
    }

    /**
     * @throws Exception\TransportNotFoundException
     */
    public function sendRemindSms(Customer $customer): void
    {
        $this->sendSms(
            SmsCodeEnum::Remind,
            $customer->getCountry(),
            $customer->getPhone(),
            [
                'name' => $customer->getName(),
                'password' => $customer->getPassword()
            ]);
    }

    /**
     * @throws Exception\TransportNotFoundException
     */
    public function sendRegisterSms(Customer $customer): void
    {
        $this->sendSms(
            SmsCodeEnum::Register,
            $customer->getCountry(),
            $customer->getPhone(),
            [
                'name' => $customer->getName()
            ]);
    }

    /**
     * @throws Exception\TransportNotFoundException
     */
    protected function sendSms(
        SmsCodeEnum $smsCode,
        string $countryCode,
        string $phoneNumber,
        array $vars = []
    ): void {
        $message = $this->messageManager->getMessageByCode($smsCode);
        $messageText = $this->messageManager->prepareMessageText($message, $vars);

        $this->transportManager->send(
            $message->getTransport(),
            $countryCode,
            $phoneNumber,
            $messageText
        );
    }
}
