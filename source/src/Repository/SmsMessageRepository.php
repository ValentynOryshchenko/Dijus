<?php

namespace App\Repository;

use App\Entity\SmsMessage;
use App\Enum\SmsCodeEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SmsMessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmsMessage::class);
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function getMessageByCode(SmsCodeEnum $smsCodeEnum): SmsMessage
    {
        return $this->createQueryBuilder('m')
            ->where('m.code = :code')
                ->setParameter('code', $smsCodeEnum->value)
            ->getQuery()
            ->getSingleResult();
    }
}