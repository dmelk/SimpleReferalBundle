<?php

namespace Melk\SimpleReferalBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\UserInterface;

/**
 * Class ReferalCode: referal code entity for user
 *
 * @ORM\MappedSuperclass
 *
 * @package Melk\SimpleReferalBundle\Entity
 */
class ReferalCode implements ReferalCodeInterface{

    /**
     * Primary index
     *
     * @var integer
     */
    protected $id;

    /**
     * Link to the user
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * Unique referal code
     *
     * @ORM\Column(type="string", length=6, unique=true)
     *
     * @var string
     */
    protected $code;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return ReferalCode
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set user
     *
     * @param UserInterface $user
     * @return ReferalCode
     */
    public function setUser(UserInterface $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return UserInterface
     */
    public function getUser()
    {
        return $this->user;
    }
}
