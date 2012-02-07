<?php

namespace Acme\ResponseListenerBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class ResponseListener
{
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $request = $event->getRequest();
        if ($request->getRequestFormat() === 'csv') {
            $event->getResponse()->headers->set('Content-Disposition', 'attachment; filename=ResponseListenerBundle.csv');
            $event->getResponse()->headers->set('Content-Type', 'application/octet-stream; name=ResponseListenerBundle.csv');
        }
    }
}