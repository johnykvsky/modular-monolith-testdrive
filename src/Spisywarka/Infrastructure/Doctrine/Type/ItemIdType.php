<?php

namespace Spisywarka\Infrastructure\Doctrine\Type;

use Spisywarka\Domain\Model\ItemId;
use Spisywarka\Infrastructure\Doctrine\Common\AbstractUuidType;

final class ItemIdType extends AbstractUuidType
{
    public const ITEM_ID = 'item_id';

    public function getName(): string
    {
        return self::ITEM_ID;
    }

    protected function getValueObjectClassName(): string
    {
        return ItemId::class;
    }
}
