<?php

namespace Spisywarka\Application\EventHandler;

use Spisywarka\Application\Event\ItemUpdatedEvent;
use Spisywarka\Application\Interface\EventHandlerInterface;

class ItemUpdatedEventHandler implements EventHandlerInterface
{
    public function __invoke(ItemUpdatedEvent $event): void
    {
    }
}
