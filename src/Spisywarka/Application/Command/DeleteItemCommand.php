<?php

namespace Spisywarka\Application\Command;

use Spisywarka\Application\CommandHandler\DeleteItemCommandHandler;
use Spisywarka\Domain\Model\ItemId;

/** @see DeleteItemCommandHandler */
class DeleteItemCommand
{
    private ItemId $id;

    public function __construct(ItemId $id) {
        $this->id = $id;
    }

    public function id(): ItemId
    {
        return $this->id;
    }
}
