<?php

namespace App\Enum;

enum SmsCodeEnum: string
{
    case Remind = 'REMIND';
    case Register = 'REGISTER';
}