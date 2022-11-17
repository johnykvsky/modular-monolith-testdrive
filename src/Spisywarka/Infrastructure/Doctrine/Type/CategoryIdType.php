<?php

namespace Spisywarka\Infrastructure\Doctrine\Type;

use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Infrastructure\Doctrine\Common\AbstractUuidType;

final class CategoryIdType extends AbstractUuidType
{
    public const CATEGORY_ID = 'category_id';

    public function getName(): string
    {
        return self::CATEGORY_ID;
    }

    protected function getValueObjectClassName(): string
    {
        return CategoryId::class;
    }
}
