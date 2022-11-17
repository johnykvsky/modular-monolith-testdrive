<?php

namespace Spisywarka\Application\Event;

use Spisywarka\Application\EventHandler\ItemCreatedEventHandler;
use Spisywarka\Domain\Model\ItemId;

/** @see ItemCreatedEventHandler */
class ItemCreatedEvent
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
