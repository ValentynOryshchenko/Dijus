<?php

namespace App\Controller;

use App\Repository\CustomerRepository;
use App\Service\Notification\Sms\SmsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AuthController extends AbstractController
{
    private SmsManager $smsManager;
    private CustomerRepository $customerRepository;

    public function __construct(SmsManager $smsManager, CustomerRepository $customerRepository)
    {
        $this->smsManager = $smsManager;
        $this->customerRepository = $customerRepository;
    }

    #[Route('/auth/remind', name: 'authRemind')]
    public function remindAction(): JsonResponse
    {
        //TODO: remind user logic

        /* Отримати юзера мали б в коді вище, тому достаем будь якого для тесту */
        $remindCustomer = $this->customerRepository->getByEmail('nan@to.net.ua');
        $this->smsManager->sendRemindSms($remindCustomer);

        return new JsonResponse([], 201);
    }

    #[Route('/auth/register', name: 'authRegister')]
    public function registerAction(): JsonResponse
    {
        //TODO: register user logic

        /* Отримати юзера мали б в коді вище, тому достаем будь якого для тесту */
        $registerCustomer = $this->customerRepository->getByEmail('nan@to.net.ua');
        $this->smsManager->sendRegisterSms($registerCustomer);

        return new JsonResponse([], 201);
    }
}
