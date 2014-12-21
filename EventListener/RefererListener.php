<?php

namespace Melk\SimpleReferalBundle\EventListener;

use Melk\SimpleReferalBundle\Entity\ReferalCodeInterface;
use Melk\SimpleReferalBundle\Service\ReferalService;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Routing\RouterInterface;

class RefererListener {

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ReferalService
     */
    private $referalService;

    public function __construct(RouterInterface $router, ReferalService $referalService)
    {
        $this->router = $router;
        $this->referalService = $referalService;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if (!$event->isMasterRequest()) {
            // don't do anything if it's not the master request
            return;
        }

        $request = $event->getRequest();
        $query = $request->query;
        $ref = $query->get('ref', null);

        if ($ref === null) return;

        $refCode = $this->referalService->findReferalCode($ref);
        if ($refCode instanceof ReferalCodeInterface){
            $this->referalService->saveReferalInfo($refCode, $request->getClientIp(), $request->headers->get('referer', ''), new \DateTime());
        }

        $params = $request->get('_route_params') + $request->query->all();
        unset($params['ref']);
        $url = $this->router->generate($request->get('_route'), $params, RouterInterface::ABSOLUTE_URL);
        $event->setResponse(new RedirectResponse($url));
    }

} 