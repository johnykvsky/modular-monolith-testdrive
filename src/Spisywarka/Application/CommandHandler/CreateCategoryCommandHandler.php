<?php

namespace Spisywarka\Application\CommandHandler;

use Psr\Log\LoggerInterface;
use Spisywarka\Application\Command\CreateCategoryCommand;
use Spisywarka\Application\Event\CategoryCreatedEvent;
use Spisywarka\Application\Exception\CategoryNotCreatedException;
use Spisywarka\Application\Interface\CommandHandlerInterface;
use Spisywarka\Domain\Model\Category;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineCategoryRepository;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class CreateCategoryCommandHandler implements CommandHandlerInterface
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

    public function __invoke(CreateCategoryCommand $command): void
    {
        try {
            $slug = $this->slugger->slug($command->name())->toString();
            $category = new Category($command->id(), $command->name(), $slug);

            $this->categoryRepository->save($category);
            $this->eventBus->dispatch(new CategoryCreatedEvent($category->id()));
            $this->logger->info('Category created: ' . $category->id());
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            throw new CategoryNotCreatedException($e->getMessage());
        }
    }

}
