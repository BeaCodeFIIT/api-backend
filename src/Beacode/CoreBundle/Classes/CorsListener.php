<?php
/**
 * Created by PhpStorm.
 * User: georg
 * Date: 7.11.2016
 * Time: 14:36
 */

namespace Beacode\CoreBundle\Classes;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class CorsListener implements EventSubscriberInterface {

    public static function getSubscribedEvents() {
        return array(
            KernelEvents::REQUEST  => array('onKernelRequest', 9999),
            KernelEvents::RESPONSE => array('onKernelResponse', 9999),
        );
    }

    public function onKernelRequest(GetResponseEvent $event) {
        //don't do anything if it's not the master request
        if (!$event->isMasterRequest()) return;

        $request = $event->getRequest();
        $method  = $request->getRealMethod();
        if ('OPTIONS' == $method) {
            $response = new Response();
            $event->setResponse($response);
        }
    }

    public function onKernelResponse(FilterResponseEvent $event) {
        //don't do anything if it's not the master request
        if (!$event->isMasterRequest()) return;

        $response = $event->getResponse();
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'GET,POST,PUT,DELETE,PATCH');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type');
    }
}
