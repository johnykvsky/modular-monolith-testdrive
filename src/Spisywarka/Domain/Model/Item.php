<?php

declare(strict_types=1);

namespace Spisywarka\Domain\Model;

use DateTimeImmutable;
use JsonSerializable;
use Webmozart\Assert\Assert;

//TODO make final
class Item implements JsonSerializable
{
    private ItemId $id;
    private string $name;
    private string $slug;
    private ?string $author;
    private ?string $originalTitle;
    private ?string $description;
    private ?string $content; //track listing, book index
    private ?int $partsCount; //how many items in series / boxrelease
    private ?string $mediumType; //paper, cd, ebook
    private ?DateTimeImmutable $firstReleaseDate;
    private ?DateTimeImmutable $releaseDate;
    private ?string $addons; //extra items added to release like postcards
    private ?int $position;
    private ?string $translatedBy; //mastered by
    private ?string $masteredBy; //mastered by
    private ?string $coverType; //digipack, soft cover, hard cover
    private ?int $editionNumber;
    private ?string $infoUrl;
    private ?string $imageUrl;
    private ?string $tags;

    private ?Category $category;
    private ?Item $parent;
    private DateTimeImmutable $createdAt;
    private DateTimeImmutable $updatedAt;

    public function __construct(
        ItemId $itemId,
        string $name,
        string $slug,
        ?Category $category,
        ?Item $parent,
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
        ?string $tags
    ) {
        Assert::notEmpty($name, "Name can't be empty");

        $this->id = $itemId;
        $this->category = $category;
        $this->name = $name;
        //slug should be unique
        $this->slug = $slug;
        $this->parent = $parent;
        $this->author = $author;
        $this->originalTitle = $originalTitle;
        $this->description = $description;
        $this->content = $content;
        $this->partsCount = $partsCount;
        $this->mediumType = $mediumType;
        $this->firstReleaseDate =  $firstReleaseDate;
        $this->releaseDate = $releaseDate;
        $this->addons = $addons;
        $this->position = $position;
        $this->translatedBy = $translatedBy;
        $this->masteredBy = $masteredBy;
        $this->coverType = $coverType;
        $this->editionNumber = $editionNumber;
        $this->infoUrl = $infoUrl ? filter_var( $infoUrl, FILTER_SANITIZE_URL) : null;
        $this->imageUrl = $imageUrl ? filter_var( $imageUrl, FILTER_SANITIZE_URL) : null;
        $this->tags = $tags;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function slug(): string
    {
        return $this->slug;
    }

    public function id(): ItemId
    {
        return $this->id;
    }

    public function category(): ?Category
    {
        return $this->category;
    }

    public function parent(): ?Item
    {
        return $this->parent;
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

    public function tags(): ?string
    {
        return $this->tags;
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

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function setAuthor(?string $author): void
    {
        $this->author = $author;
    }

    public function setOriginalTitle(?string $originalTitle): void
    {
        $this->originalTitle = $originalTitle;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    public function setPartsCount(?int $partsCount): void
    {
        $this->partsCount = $partsCount;
    }

    public function setMediumType(?string $mediumType): void
    {
        $this->mediumType = $mediumType;
    }

    public function setFirstReleaseDate(?DateTimeImmutable $firstReleaseDate): void
    {
        $this->firstReleaseDate = $firstReleaseDate;
    }

    public function setReleaseDate(?DateTimeImmutable $releaseDate): void
    {
        $this->releaseDate = $releaseDate;
    }

    public function setAddons(?string $addons): void
    {
        $this->addons = $addons;
    }

    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    public function setTranslatedBy(?string $translatedBy): void
    {
        $this->translatedBy = $translatedBy;
    }

    public function setMasteredBy(?string $masteredBy): void
    {
        $this->masteredBy = $masteredBy;
    }


    public function setCoverType(?string $coverType): void
    {
        $this->coverType = $coverType;
    }

    public function setEditionNumber(?int $editionNumber): void
    {
        $this->editionNumber = $editionNumber;
    }

    public function setInfoUrl(mixed $infoUrl): void
    {
        $this->infoUrl = $infoUrl;
    }

    public function setImageUrl(mixed $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }


    public function setTags(?string $tags): void
    {
        $this->tags = $tags;
    }

    public function setCategory(?Category $category): void
    {
        $this->category = $category;
    }

    public function setParent(?Item $parent): void
    {
        $this->parent = $parent;
    }

    public function getFilteredTags(): ?array
    {
        if (null === $this->tags) {
            return null;
        }

        return array_values(array_filter(explode('|', $this->tags), static fn (string $tag) => !empty($tag)));
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id()->value(),
            'name' => $this->name(),
            'slug' => $this->slug(),
            'parent_id' => $this->parent() ? [
                'id' => $this->parent()->id()->value(),
                'name' => $this->parent()->name(),
                'slug' => $this->parent()->slug(),
            ] : null,
            'category_id' => $this->category() ? [
                'id' => $this->category()->id()->value(),
                'name' => $this->category()->name(),
                'slug' => $this->category()->slug(),
            ] : null,
            'author' => $this->author(),
            'original_title' => $this->originalTitle(),
            'description' => $this->description(),
            'content' => $this->content(),
            'parts_count' => $this->partsCount(),
            'medium_type' => $this->mediumType(),
            'first_release_date' => $this->firstReleaseDate() ? $this->firstReleaseDate()->format('Y-m-d') : null,
            'release_date' => $this->releaseDate() ? $this->releaseDate()->format('Y-m-d') : null,
            'addons' => $this->addons(),
            'position' => $this->position(),
            'translated_by' => $this->translatedBy(),
            'mastered_by' => $this->masteredBy(),
            'cover_type' => $this->coverType(),
            'edition_number' => $this->editionNumber(),
            'info_url' => $this->infoUrl(),
            'image_url' => $this->imageUrl(),
            'tags' => $this->getFilteredTags(),
        ];
    }
}