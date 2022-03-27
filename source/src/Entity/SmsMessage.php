<?php

namespace App\Entity;

use App\Entity\Trait\IdTrait;
use App\Entity\Trait\ImageTrait;
use App\Enum\SmsCodeEnum;
use App\Enum\SmsTransportEnum;
use App\Repository\SmsMessageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SmsMessageRepository::class)]
class SmsMessage
{
    use IdTrait;

    #[ORM\Column(type: Types::STRING, length: 20, unique: true)]
    private string $code;

    #[ORM\Column(type: Types::TEXT)]
    private string $message;

    #[ORM\Column(type: Types::STRING, length: 20)]
    private string $transport;

    public function getCode(): SmsCodeEnum
    {
        return SmsCodeEnum::from($this->code);
    }

    public function setCode(SmsCodeEnum $code): self
    {
        $this->code = $code->value;

        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getTransport(): SmsTransportEnum
    {
        return SmsTransportEnum::from($this->transport);
    }

    public function setTransport(SmsTransportEnum $transport): self
    {
        $this->transport = $transport->value;

        return $this;
    }
}
