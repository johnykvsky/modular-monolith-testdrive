<?php

namespace Spisywarka\Application\EventHandler;

use Spisywarka\Application\Event\ItemCreatedEvent;
use Spisywarka\Application\Interface\EventHandlerInterface;

class ItemCreatedEventHandler implements EventHandlerInterface
{
    public function __invoke(ItemCreatedEvent $event): void
    {
    }
}
