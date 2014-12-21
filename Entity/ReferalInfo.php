<?php

namespace Melk\SimpleReferalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ReferalInfo: save referal info
 *
 * @ORM\MappedSuperclass()
 *
 * @package Melk\SimpleReferalBundle\Entity
 */
class ReferalInfo implements ReferalInfoInterface{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var ReferalCodeInterface
     */
    protected $refCode;

    /**
     * IP address
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $ip;

    /**
     * Referer
     *
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $refer;

    /**
     * Request date
     *
     * @ORM\Column(type="date")
     *
     * @var \DateTime
     */
    protected $date;

    /**
     * Set ip
     *
     * @param string $ip
     * @return ReferalInfo
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string 
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set refer
     *
     * @param string $refer
     * @return ReferalInfo
     */
    public function setRefer($refer)
    {
        $this->refer = $refer;

        return $this;
    }

    /**
     * Get refer
     *
     * @return string 
     */
    public function getRefer()
    {
        return $this->refer;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ReferalInfo
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * Set refCode
     *
     * @param ReferalCodeInterface $code
     * @return ReferalInfoInterface
     */
    public function setRefCode (ReferalCodeInterface $code)
    {
        $this->refCode = $code;
        return $this;
    }

    /**
     * Get refCode
     *
     * @return ReferalCodeInterface
     */
    public function getRefCode ()
    {
        return $this->refCode;
    }
}
