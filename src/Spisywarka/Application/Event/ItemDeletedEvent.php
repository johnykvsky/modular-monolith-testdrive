<?php

namespace Spisywarka\Application\Event;

use Spisywarka\Application\EventHandler\ItemDeletedEventHandler;
use Spisywarka\Domain\Model\ItemId;

/** @see ItemDeletedEventHandler */
class ItemDeletedEvent
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
