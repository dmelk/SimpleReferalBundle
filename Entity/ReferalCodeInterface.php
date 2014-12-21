<?php

namespace Melk\SimpleReferalBundle\Entity;

use FOS\UserBundle\Model\UserInterface;

/**
 * Interface for the referal codes entities
 *
 * @package Melk\SimpleReferalBundle\Entity
 */
interface ReferalCodeInterface {

    /**
     * Get id
     *
     * @return integer
     */
    public function getId();

    /**
     * Set code
     *
     * @param string $code
     * @return ReferalCodeInterface
     */
    public function setCode($code);

    /**
     * Get code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return ReferalCodeInterface
     */
    public function setUser(UserInterface $user = null);

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser();
}