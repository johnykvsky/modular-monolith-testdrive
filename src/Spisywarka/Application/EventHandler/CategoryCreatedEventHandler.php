<?php

namespace Spisywarka\Application\EventHandler;

use Spisywarka\Application\Event\CategoryCreatedEvent;
use Spisywarka\Application\Interface\EventHandlerInterface;

class CategoryCreatedEventHandler implements EventHandlerInterface
{
    public function __invoke(CategoryCreatedEvent $event): void
    {
    }
}
