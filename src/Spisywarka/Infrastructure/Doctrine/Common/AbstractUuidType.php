<?php

namespace Spisywarka\Infrastructure\Doctrine\Common;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\StringType;
use Spisywarka\Domain\Common\UuidId;

abstract class AbstractUuidType extends StringType
{
    private const LENGTH = 36;

    public function getSqlDeclaration(array $column, AbstractPlatform $platform): string
    {
        return sprintf('CHAR(%d) COMMENT \'(DC2Type:uuid)\'', self::LENGTH);
    }

    /**
     * @param string|null $value
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): ?UuidId
    {
        if (empty($value)) {
            return null;
        }

        $class = $this->getValueObjectClassName();

        return new $class($value);
    }

    /**
     * @param UuidId|null $value
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof UuidId) {
            return $value->value();
        }

        throw ConversionException::conversionFailed($value, $this->getName());
    }

    protected function getValueObjectClassName(): string
    {
        return '';
    }
}