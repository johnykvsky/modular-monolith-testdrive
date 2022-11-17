<?php

namespace Spisywarka\Application\Event;

use Spisywarka\Application\EventHandler\CategoryDeletedEventHandler;
use Spisywarka\Domain\Model\CategoryId;

/** @see CategoryDeletedEventHandler */
class CategoryDeletedEvent
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
