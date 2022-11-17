<?php

namespace Spisywarka\Application\Event;

use Spisywarka\Application\EventHandler\ItemUpdatedEventHandler;
use Spisywarka\Domain\Model\ItemId;

/** @see ItemUpdatedEventHandler */
class ItemUpdatedEvent
{
    private ItemId $id;

    public function __construct(ItemId $id)
    {
        $this->id = $id;
    }

    public function id(): ItemId
    {
        return $this->id;
    }
}
