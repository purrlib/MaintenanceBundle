<?php

namespace PurrLib\MaintenanceBundle\EventListener;

use PurrLib\MaintenanceBundle\Manager\MaintenanceManager;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class MaintenanceListener implements EventSubscriberInterface
{
    /**
     * @var MaintenanceManager
     */
    private $maintenanceManager;

    /**
     * MaintenanceListener constructor.
     * @param MaintenanceManager $maintenanceManager
     */
    public function __construct(MaintenanceManager $maintenanceManager)
    {
        $this->maintenanceManager = $maintenanceManager;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [ 'onKernelRequest' ]
        ];
    }

    /**
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
        // Do not modify sub-requests
        if (!$event->isMasterRequest()) {
            return;
        }

        /** @var string $clientIp */
        $clientIp = $event->getRequest()->getClientIp();
        /** @var array $authorizedIps */
        $authorizedIps = $this->maintenanceManager->getAuthorizedIps();

        if (!$this->maintenanceManager->isMaintenanceEnabled()) {
            return;
        }

        if (in_array($clientIp, $authorizedIps, true)) {
            return;
        }

        $view = $this->maintenanceManager->renderMaintenancePage();
        $event->setResponse(new Response($view, Response::HTTP_SERVICE_UNAVAILABLE));
        $event->stopPropagation();
    }
}
