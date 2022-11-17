<?php

namespace Spisywarka\Application\CommandHandler;

use Psr\Log\LoggerInterface;
use Spisywarka\Application\Command\DeleteCategoryCommand;
use Spisywarka\Application\Event\CategoryDeletedEvent;
use Spisywarka\Application\Exception\CategoryNotDeletedException;
use Spisywarka\Application\Interface\CommandHandlerInterface;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineCategoryRepository;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteCategoryCommandHandler implements CommandHandlerInterface
{
    private DoctrineCategoryRepository $categoryRepository;
    private LoggerInterface $logger;
    private MessageBusInterface $eventBus;

    public function __construct(
        DoctrineCategoryRepository $categoryRepository,
        LoggerInterface $logger,
        MessageBusInterface $eventBus
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->logger = $logger;
        $this->eventBus = $eventBus;
    }

    public function __invoke(DeleteCategoryCommand $command): void
    {
        try {
            $category = $this->categoryRepository->getCategory($command->id());

            if ($category->items() && !$category->items()->isEmpty()) {
                throw new \Exception('Category has items assigned');
            }

            $this->categoryRepository->remove($category);
            $this->eventBus->dispatch(new CategoryDeletedEvent($command->id()));
            $this->logger->info('Category deleted: ' . $command->id());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new CategoryNotDeletedException($e->getMessage());
        }
    }

}
