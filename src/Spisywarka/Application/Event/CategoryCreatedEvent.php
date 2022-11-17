<?php

namespace Spisywarka\Application\Event;

use Spisywarka\Application\EventHandler\CategoryCreatedEventHandler;
use Spisywarka\Domain\Model\CategoryId;

/** @see CategoryCreatedEventHandler */
class CategoryCreatedEvent
{
    private CategoryId $id;

    public function __construct(CategoryId $id)
    {
        $this->id = $id;
    }

    public function id(): CategoryId
    {
        return $this->id;
    }
}
