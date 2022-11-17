<?php

namespace Spisywarka\Application\Command;

use Spisywarka\Application\CommandHandler\DeleteCategoryCommandHandler;
use Spisywarka\Domain\Model\CategoryId;

/** @see DeleteCategoryCommandHandler */
class DeleteCategoryCommand
{
    private CategoryId $id;

    public function __construct(CategoryId $id) {
        $this->id = $id;
    }

    public function id(): CategoryId
    {
        return $this->id;
    }
}
