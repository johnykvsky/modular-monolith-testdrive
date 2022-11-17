<?php

namespace Spisywarka\Application\Request;

use DateTimeImmutable;
use JMS\Serializer\Annotation\Type;
use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Domain\Model\ItemId;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateItemRequest
{
    /**
     * @Type("string")
     * @Assert\NotBlank()
     * @Assert\Length(max=255)
     */
    private string $name;
    /**
     * @Type("string")
     * @Assert\Uuid()
     */
    private ?string $parentId = null;
    /**
     * @Type("string")
     * @Assert\Uuid()
     */
    private ?string $categoryId = null;
    /**
     * @Type("string")
     * @Assert\Length(max=255)
     */
    private ?string $author = null;
    /**
     * @Type("string")
     * @Assert\Length(max=255)
     */
    private ?string $originalTitle = null;
    /**
     * @Type("string")
     * @Assert\Length(max=65000)
     */
    private ?string $description = null;
    /**
     * @Type("string")
     * @Assert\Length(max=65000)
     */
    private ?string $content = null;
    /**
     * @Type("integer")
     */
    private ?int $partsCount = null;
    /**
     * @Type("string")
     * @Assert\Length(max=255)
     */
    private ?string $mediumType = null;
    /**
     * @Type("string")
     * @Assert\Date()
     */
    private ?string $firstReleaseDate = null;
    /**
     * @Type("string")
     * @Assert\Date()
     */
    private ?string $releaseDate = null;
    /**
     * @Type("string")
     * @Assert\Length(max=65000)
     */
    private ?string $addons = null;
    /**
     * @Type("integer")
     */
    private ?int $position = null;
    /**
     * @Type("string")
     * @Assert\Length(max=255)
     */
    private ?string $translatedBy = null;
    /**
     * @Type("string")
     * @Assert\Length(max=255)
     */
    private ?string $masteredBy = null;
    /**
     * @Type("string")
     * @Assert\Length(max=255)
     */
    private ?string $coverType = null;
    /**
     * @Type("integer")
     */
    private ?int $editionNumber = null;
    /**
     * @Type("string")
     * @Assert\Length(max=255)
     */
    private ?string $infoUrl = null;
    /**
     * @Type("string")
     * @Assert\Length(max=255)
     */
    private ?string $imageUrl = null;
    /**
     * @Type("array")
     * @Assert\All(
     *     {@Assert\Length(max=255)}
     * )
     */
    private ?array $tags = null;

    public function __construct(
        string $name,
        ?string $parentId,
        ?string $categoryId,
        ?string $author,
        ?string $originalTitle,
        ?string $description,
        ?string $content,
        ?int $partsCount,
        ?string $mediumType,
        ?string $firstReleaseDate,
        ?string $releaseDate,
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

    public function name(): string
    {
        return $this->name;
    }

    public function parentId(): ?ItemId
    {
        return $this->parentId ? new ItemId($this->parentId) : null;
    }

    public function categoryId(): ?CategoryId
    {
        return $this->categoryId ? new CategoryId($this->categoryId) : null;
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
        return $this->firstReleaseDate ? DateTimeImmutable::createFromFormat('Y-m-d', $this->firstReleaseDate) : null;
    }

    public function releaseDate(): ?DateTimeImmutable
    {
        return $this->releaseDate ? DateTimeImmutable::createFromFormat('Y-m-d', $this->releaseDate) : null;
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
        return $this->infoUrl ? filter_var( $this->infoUrl, FILTER_SANITIZE_URL) : null;
    }

    public function imageUrl(): ?string
    {
        return $this->imageUrl ? filter_var( $this->imageUrl, FILTER_SANITIZE_URL) : null;
    }

    public function tags(): ?array
    {
        return $this->tags;
    }
}
