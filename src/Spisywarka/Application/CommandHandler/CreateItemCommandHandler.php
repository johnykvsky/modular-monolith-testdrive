<?php

namespace Spisywarka\Application\CommandHandler;

use Psr\Log\LoggerInterface;
use Spisywarka\Application\Command\CreateItemCommand;
use Spisywarka\Application\Event\ItemCreatedEvent;
use Spisywarka\Application\Exception\ItemNotCreatedException;
use Spisywarka\Application\Interface\CommandHandlerInterface;
use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Domain\Model\Item;
use Spisywarka\Domain\Model\ItemId;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineCategoryRepository;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineItemRepository;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class CreateItemCommandHandler implements CommandHandlerInterface
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

    public function __invoke(CreateItemCommand $command): void
    {
        try {
            $slug = $this->slugger->slug($command->name())->toString();

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

            $item = new Item(
                $command->id(),
                $command->name(),
                $slug,
                $category,
                $parent,
                $command->author(),
                $command->originalTitle(),
                $command->description(),
                $command->content(),
                $command->partsCount(),
                $command->mediumType(),
                $command->firstReleaseDate(),
                $command->releaseDate(),
                $command->addons(),
                $command->position(),
                $command->translatedBy(),
                $command->masteredBy(),
                $command->coverType(),
                $command->editionNumber(),
                $command->infoUrl(),
                $command->imageUrl(),
                $tags
            );

            $this->itemRepository->save($item);
            $this->eventBus->dispatch(new ItemCreatedEvent($item->id()));
            $this->logger->info('Item created: ' . $item->id());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new ItemNotCreatedException($e->getMessage());
        }
    }

}
