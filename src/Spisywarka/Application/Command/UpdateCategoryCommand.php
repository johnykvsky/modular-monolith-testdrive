<?php

namespace Spisywarka\Application\Command;

use Spisywarka\Application\CommandHandler\UpdateCategoryCommandHandler;
use Spisywarka\Domain\Model\CategoryId;

/** @see UpdateCategoryCommandHandler */
class UpdateCategoryCommand
{
    private CategoryId $id;
    private string $name;

    public function __construct(CategoryId $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }
}
