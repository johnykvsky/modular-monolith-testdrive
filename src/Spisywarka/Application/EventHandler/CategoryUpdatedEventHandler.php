<?php

namespace Spisywarka\Application\EventHandler;

use Spisywarka\Application\Event\CategoryUpdatedEvent;
use Spisywarka\Application\Interface\EventHandlerInterface;

class CategoryUpdatedEventHandler implements EventHandlerInterface
{
    public function __invoke(CategoryUpdatedEvent $event): void
    {
    }
}
