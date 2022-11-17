<?php

namespace Spisywarka\Application\EventHandler;

use Spisywarka\Application\Event\ItemDeletedEvent;
use Spisywarka\Application\Interface\EventHandlerInterface;

class ItemDeletedEventHandler implements EventHandlerInterface
{
    public function __invoke(ItemDeletedEvent $event): void
    {
    }
}
