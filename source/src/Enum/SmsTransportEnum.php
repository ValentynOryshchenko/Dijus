<?php

namespace App\Enum;

enum SmsTransportEnum: string
{
    case Local = 'local';
    case Remote = 'remote';
}