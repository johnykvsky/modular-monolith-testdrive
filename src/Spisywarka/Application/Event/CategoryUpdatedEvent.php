<?php

namespace Spisywarka\Application\Event;

use Spisywarka\Application\EventHandler\CategoryUpdatedEventHandler;
use Spisywarka\Domain\Model\CategoryId;

/** @see CategoryUpdatedEventHandler */
class CategoryUpdatedEvent
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
