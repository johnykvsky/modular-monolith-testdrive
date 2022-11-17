<?php

namespace Spisywarka\Domain\Common;

abstract class UuidId
{
    protected const VALID_REGEX = '/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}/i';
    protected string $uuid;

    public function __construct(string $uuid)
    {
        if (!preg_match(self::VALID_REGEX, $uuid)) {
            throw new \InvalidArgumentException('Not valid UUID');
        }

        $this->uuid = $uuid;
    }

    public function value(): string
    {
        return $this->uuid;
    }

    public function __toString(): string
    {
        return $this->uuid;
    }
}