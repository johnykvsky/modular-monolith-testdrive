<?php

namespace Spisywarka\Application\CommandHandler;

use Psr\Log\LoggerInterface;
use Spisywarka\Application\Command\DeleteItemCommand;
use Spisywarka\Application\Event\ItemDeletedEvent;
use Spisywarka\Application\Exception\ItemNotDeletedException;
use Spisywarka\Application\Interface\CommandHandlerInterface;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineItemRepository;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteItemCommandHandler implements CommandHandlerInterface
{
    private DoctrineItemRepository $itemRepository;
    private LoggerInterface $logger;
    private MessageBusInterface $eventBus;

    public function __construct(
        DoctrineItemRepository $itemRepository,
        LoggerInterface $logger,
        MessageBusInterface $eventBus
    ) {
        $this->itemRepository = $itemRepository;
        $this->logger = $logger;
        $this->eventBus = $eventBus;
    }

    public function __invoke(DeleteItemCommand $command): void
    {
        try {
            $item = $this->itemRepository->getItem($command->id());;
            $this->itemRepository->remove($item);
            $this->eventBus->dispatch(new ItemDeletedEvent($item->id()));
            $this->logger->info('Item deleted: ' . $command->id());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new ItemNotDeletedException($e->getMessage());
        }
    }

}
