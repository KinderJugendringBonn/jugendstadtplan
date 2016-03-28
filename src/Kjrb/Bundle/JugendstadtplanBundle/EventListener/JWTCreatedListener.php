<?php

namespace Kjrb\Bundle\JugendstadtplanBundle\EventListener;

use Kjrb\Bundle\JugendstadtplanBundle\Entity\Traeger;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JWTCreatedListener
{

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        if (!($request = $event->getRequest())) {
            return;
        }

        /** @var Traeger $traeger */
        $traeger = $event->getUser();

        $payload = $event->getData();
        $payload['traeger'] = array();
        $payload['traeger']['titel'] = $traeger->getTitel();

        $event->setData($payload);
    }

}