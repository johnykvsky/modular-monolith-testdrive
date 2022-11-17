<?php

namespace Spisywarka\Application\CommandHandler;

use Psr\Log\LoggerInterface;
use Spisywarka\Application\Command\UpdateItemCommand;
use Spisywarka\Application\Event\ItemUpdatedEvent;
use Spisywarka\Application\Exception\ItemNotUpdatedException;
use Spisywarka\Application\Interface\CommandHandlerInterface;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineCategoryRepository;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineItemRepository;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UpdateItemCommandHandler implements CommandHandlerInterface
{
    private DoctrineItemRepository $itemRepository;
    private DoctrineCategoryRepository $categoryRepository;
    private SluggerInterface $slugger;
    private LoggerInterface $logger;
    private MessageBusInterface $eventBus;

    public function __construct(
        DoctrineItemRepository $itemRepository,
        DoctrineCategoryRepository $categoryRepository,
        SluggerInterface $slugger,
        LoggerInterface $logger,
        MessageBusInterface $eventBus
    ) {
        $this->itemRepository = $itemRepository;
        $this->categoryRepository = $categoryRepository;
        $this->slugger = $slugger;
        $this->logger = $logger;
        $this->eventBus = $eventBus;
    }

    public function __invoke(UpdateItemCommand $command): void
    {
        try {
            $slug = $this->slugger->slug($command->name())->toString();
            $item = $this->itemRepository->getItem($command->id());
            $item->setName($command->name());
            $item->setSlug($slug);

            $parent = null;
            $category = null;
            $tags = null;

            if ($command->categoryId()) {
                $category = $this->categoryRepository->getCategory($command->categoryId());
            }

            if ($command->parentId()) {
                $parent = $this->itemRepository->getItem($command->parentId());
            }

            if ($command->tags()) {
                $tags = array_map(static fn (string $tag) => trim($tag), $command->tags());
                $tags = '|'.implode('|', $tags).'|';
            }

            $item->setParent($parent);
            $item->setCategory($category);
            $item->setAuthor($command->author());
            $item->setOriginalTitle($command->originalTitle());
            $item->setDescription($command->description());
            $item->setContent($command->content());
            $item->setPartsCount($command->partsCount());
            $item->setMediumType($command->mediumType());
            $item->setFirstReleaseDate($command->firstReleaseDate());
            $item->setReleaseDate($command->releaseDate());
            $item->setAddons($command->addons());
            $item->setPosition($command->position());
            $item->setTranslatedBy($command->translatedBy());
            $item->setMasteredBy($command->masteredBy());
            $item->setCoverType($command->coverType());
            $item->setEditionNumber($command->editionNumber());
            $item->setInfoUrl($command->infoUrl());
            $item->setImageUrl($command->imageUrl());
            $item->setTags($tags);

            $this->itemRepository->save($item);
            $this->eventBus->dispatch(new ItemUpdatedEvent($item->id()));
            $this->logger->info('Item updated: ' . $item->id());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new ItemNotUpdatedException($e->getMessage());
        }
    }

}
