<?php

declare(strict_types=1);

namespace Spisywarka\Domain\Model;

use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use JsonSerializable;
use Webmozart\Assert\Assert;

//TODO make final
class Category implements JsonSerializable
{
    private CategoryId $id;
    private string $name;
    private string $slug;

    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    private ?Collection $items;

    public function __construct(CategoryId $categoryId, string $name, string $slug)
    {
        Assert::notEmpty($name, "Name can't be empty");

        $this->id = $categoryId;
        $this->name = $name;
        $this->slug = $slug;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function id(): CategoryId
    {
        return $this->id;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function onPrePersist(): void
    {
        $this->createdAt = new DateTimeImmutable();
        $this->updatedAt = new DateTimeImmutable();
    }

    public function onPreUpdate(): void
    {
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function items(): ?Collection
    {
        return $this->items;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'name' => $this->name(),
            'slug' => $this->slug(),
        ];
    }
}