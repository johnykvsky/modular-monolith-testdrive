<?php

namespace Spisywarka\Application\CommandHandler;

use Psr\Log\LoggerInterface;
use Spisywarka\Application\Command\UpdateCategoryCommand;
use Spisywarka\Application\Event\CategoryUpdatedEvent;
use Spisywarka\Application\Exception\CategoryNotUpdatedException;
use Spisywarka\Application\Interface\CommandHandlerInterface;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineCategoryRepository;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class UpdateCategoryCommandHandler implements CommandHandlerInterface
{
    private DoctrineCategoryRepository $categoryRepository;
    private SluggerInterface $slugger;
    private LoggerInterface $logger;
    private MessageBusInterface $eventBus;

    public function __construct(
        DoctrineCategoryRepository $categoryRepository,
        SluggerInterface $slugger,
        LoggerInterface $logger,
        MessageBusInterface $eventBus
    ) {
        $this->categoryRepository = $categoryRepository;
        $this->slugger = $slugger;
        $this->logger = $logger;
        $this->eventBus = $eventBus;
    }

    public function __invoke(UpdateCategoryCommand $command): void
    {
        try {
            $category = $this->categoryRepository->getCategory($command->id());
            $category->setName($command->name());
            $category->setSlug($this->slugger->slug($command->name())->toString());

            $this->categoryRepository->save($category);
            $this->eventBus->dispatch(new CategoryUpdatedEvent($category->id()));
            $this->logger->info('Category updated: ' . $category->id());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new CategoryNotUpdatedException($e->getMessage());
        }
    }

}
