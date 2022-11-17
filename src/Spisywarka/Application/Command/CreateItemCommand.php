<?php

namespace Spisywarka\Application\Command;

use DateTimeImmutable;
use Spisywarka\Application\CommandHandler\CreateItemCommandHandler;
use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Domain\Model\Item;
use Spisywarka\Domain\Model\ItemId;

/** @see CreateItemCommandHandler */
class CreateItemCommand
{
    private ItemId $id;
    private string $name;
    private ?Item $parentId;
    private ?CategoryId $categoryId;
    private ?string $author;
    private ?string $originalTitle;
    private ?string $description;
    private ?string $content;
    private ?int $partsCount;
    private ?string $mediumType;
    private ?DateTimeImmutable $firstReleaseDate;
    private ?DateTimeImmutable $releaseDate;
    private ?string $addons;
    private ?int $position;
    private ?string $translatedBy;
    private ?string $masteredBy;
    private ?string $coverType;
    private ?int $editionNumber;
    private ?string $infoUrl;
    private ?string $imageUrl;
    private ?array $tags;

    public function __construct(
        ItemId $id,
        string $name,
        ?ItemId $parentId,
        ?CategoryId $categoryId,
        ?string $author,
        ?string $originalTitle,
        ?string $description,
        ?string $content,
        ?int $partsCount,
        ?string $mediumType,
        ?DateTimeImmutable $firstReleaseDate,
        ?DateTimeImmutable $releaseDate,
        ?string $addons,
        ?int $position,
        ?string $translatedBy,
        ?string $masteredBy,
        ?string $coverType,
        ?int $editionNumber,
        ?string $infoUrl,
        ?string $imageUrl,
        ?array $tags
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
        $this->categoryId = $categoryId;
        $this->author = $author;
        $this->originalTitle = $originalTitle;
        $this->description = $description;
        $this->content = $content;
        $this->partsCount = $partsCount;
        $this->mediumType = $mediumType;
        $this->firstReleaseDate = $firstReleaseDate;
        $this->releaseDate = $releaseDate;
        $this->addons = $addons;
        $this->position = $position;
        $this->translatedBy = $translatedBy;
        $this->masteredBy = $masteredBy;
        $this->coverType = $coverType;
        $this->editionNumber = $editionNumber;
        $this->infoUrl = $infoUrl;
        $this->imageUrl = $imageUrl;
        $this->tags = $tags;
    }

    public function id(): ItemId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function parentId(): ?ItemId
    {
        return $this->parentId;
    }

    public function categoryId(): ?CategoryId
    {
        return $this->categoryId;
    }

    public function author(): ?string
    {
        return $this->author;
    }

    public function originalTitle(): ?string
    {
        return $this->originalTitle;
    }

    public function description(): ?string
    {
        return $this->description;
    }

    public function content(): ?string
    {
        return $this->content;
    }

    public function partsCount(): ?int
    {
        return $this->partsCount;
    }

    public function mediumType(): ?string
    {
        return $this->mediumType;
    }

    public function firstReleaseDate(): ?DateTimeImmutable
    {
        return $this->firstReleaseDate;
    }

    public function releaseDate(): ?DateTimeImmutable
    {
        return $this->releaseDate;
    }

    public function addons(): ?string
    {
        return $this->addons;
    }

    public function position(): ?int
    {
        return $this->position;
    }

    public function translatedBy(): ?string
    {
        return $this->translatedBy;
    }

    public function masteredBy(): ?string
    {
        return $this->masteredBy;
    }

    public function coverType(): ?string
    {
        return $this->coverType;
    }

    public function editionNumber(): ?int
    {
        return $this->editionNumber;
    }

    public function infoUrl(): ?string
    {
        return $this->infoUrl;
    }

    public function imageUrl(): ?string
    {
        return $this->imageUrl;
    }

    public function tags(): ?array
    {
        return $this->tags;
    }
}
