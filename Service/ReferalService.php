<?php

namespace Melk\SimpleReferalBundle\Service;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
use Melk\SimpleReferalBundle\Entity\ReferalCodeInterface;
use Melk\SimpleReferalBundle\Entity\ReferalInfoInterface;

/**
 * Referal service. Main logic is here: generate code, save refereal info, etc.
 *
 * @package Melk\SimpleReferalBundle\Service
 */
class ReferalService
{

    /**
     * Referal code class
     *
     * @var string
     */
    private $codeClass;

    /**
     * Referal info class
     *
     * @var string
     */
    private $infoClass;

    /**
     * Doctrine entity manager
     *
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em, $codeClass, $infoClass)
    {
        $this->em = $em;

        $metaData = $this->em->getClassMetadata($codeClass);
        $interfaces = $metaData->getReflectionClass()->getInterfaces();
        if (!isset($interfaces['Melk\SimpleReferalBundle\Entity\ReferalCodeInterface'])) {
            throw new \LogicException('Code class should implement Melk\SimpleReferalBundle\Entity\ReferalCodeInterface.');
        }
        $this->codeClass = $metaData->getName();

        $metaData = $this->em->getClassMetadata($infoClass);
        $interfaces = $metaData->getReflectionClass()->getInterfaces();
        if (!isset($interfaces['Melk\SimpleReferalBundle\Entity\ReferalInfoInterface'])) {
            throw new \LogicException('Info class should implement Melk\SimpleReferalBundle\Entity\ReferalInfoInterface.');
        }
        $this->infoClass = $metaData->getName();

    }

    /**
     * Searches for referal code
     *
     * @param $code
     * @return null|ReferalCodeInterface
     */
    public function findReferalCode($code) {
        return $this->em->getRepository($this->codeClass)->findOneBy(['code' => $code]);
    }

    /**
     * Saves referal info
     *
     * @param ReferalCodeInterface $refCode
     * @param $ip
     * @param $refer
     * @param \DateTime $date
     */
    public function saveReferalInfo(ReferalCodeInterface $refCode, $ip, $refer, \DateTime $date)
    {
        /** @var ReferalInfoInterface $refInfo */
        $refInfo = new $this->infoClass;
        $refInfo
            ->setRefCode($refCode)
            ->setIp($ip)
            ->setRefer($refer)
            ->setDate($date)
        ;

        $this->em->persist($refInfo);
        $this->em->flush();
    }

    /**
     * Generates unique ref code for user
     *
     * @param UserInterface $user
     */
    public function generateCodeForUser(UserInterface $user)
    {
        /** @var ReferalCodeInterface $refCode */
        $refCode = new $this->codeClass;

        $maxCode = $this->em->getRepository($this->codeClass)
            ->createQueryBuilder('c')
            ->select('MAX(c.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
        $maxCode++;

        do {

            $code = base_convert($maxCode, 10, 16);
            $len = strlen($code);
            for ($i = 0; $i < 6 - $len; $i++) {
                $code = '0'.$code;
            }

            $maxCode++;

            $foundCode = $this->findReferalCode($code);

        } while ($foundCode instanceof ReferalCodeInterface);

        $refCode->setCode($code);
        $refCode->setUser($user);

        $this->em->persist($refCode);
        $this->em->flush();
    }

}