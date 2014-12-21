<?php

namespace Melk\SimpleReferalBundle\EventListener;

use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\FOSUserEvents;
use Melk\SimpleReferalBundle\Service\ReferalService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegisteredListener implements EventSubscriberInterface{

    /**
     * @var ReferalService
     */
    private $referalService;

    public function __construct(ReferalService $referalService) {
        $this->referalService = $referalService;
    }

    public static function getSubscribedEvents ()
    {
        return [
            FOSUserEvents::REGISTRATION_COMPLETED => 'onUserRegistered'
        ];
    }

    /**
     * Generates and saves unique ref code for new user
     *
     * @param FilterUserResponseEvent $event
     */
    public function onUserRegistered(FilterUserResponseEvent $event)
    {
        $this->referalService->generateCodeForUser($event->getUser());
    }

}