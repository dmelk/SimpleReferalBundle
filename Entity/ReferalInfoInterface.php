<?php

namespace Melk\SimpleReferalBundle\Entity;

/**
 * Interface for referal info entities
 *
 * @package Melk\SimpleReferalBundle\Entity
 */
interface ReferalInfoInterface {

    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Set ip
     *
     * @param string $ip
     * @return ReferalInfoInterface
     */
    public function setIp($ip);

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp();

    /**
     * Set refer
     *
     * @param string $refer
     * @return ReferalInfoInterface
     */
    public function setRefer($refer);

    /**
     * Get refer
     *
     * @return string
     */
    public function getRefer();

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return ReferalInfoInterface
     */
    public function setDate($date);

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate();

    /**
     * Set refCode
     *
     * @param ReferalCodeInterface $code
     * @return ReferalInfoInterface
     */
    public function setRefCode(ReferalCodeInterface $code);

    /**
     * Get refCode
     *
     * @return ReferalCodeInterface
     */
    public function getRefCode();

}