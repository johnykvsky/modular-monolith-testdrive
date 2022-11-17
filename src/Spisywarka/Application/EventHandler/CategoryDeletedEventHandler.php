<?php

namespace Spisywarka\Application\EventHandler;

use Spisywarka\Application\Event\CategoryDeletedEvent;
use Spisywarka\Application\Interface\EventHandlerInterface;

class CategoryDeletedEventHandler implements EventHandlerInterface
{
    public function __invoke(CategoryDeletedEvent $event): void
    {
    }
}
