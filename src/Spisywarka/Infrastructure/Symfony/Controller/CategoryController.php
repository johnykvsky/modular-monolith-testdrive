<?php

declare(strict_types=1);

namespace Spisywarka\Infrastructure\Symfony\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Spisywarka\Application\Command\CreateCategoryCommand;
use Spisywarka\Application\Command\DeleteCategoryCommand;
use Spisywarka\Application\Command\UpdateCategoryCommand;
use Spisywarka\Application\Request\CreateCategoryRequest;
use Spisywarka\Application\Request\UpdateCategoryRequest;
use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CategoryController extends AbstractController
{
    private DoctrineCategoryRepository $doctrineCategoryRepository;
    private MessageBusInterface $commandBus;

    public function __construct(
        DoctrineCategoryRepository $doctrineCategoryRepository,
        MessageBusInterface $commandBus
    )
    {
        $this->doctrineCategoryRepository = $doctrineCategoryRepository;
        $this->commandBus = $commandBus;
    }

    #[ParamConverter('request', converter: 'fos_rest.request_body')]
    public function create(CreateCategoryRequest $request) : JsonResponse
    {
        try {
            $categoryId = new CategoryId(Uuid::uuid4()->toString());
            $this->commandBus->dispatch(new CreateCategoryCommand($categoryId, $request->name()));
            $category = $this->doctrineCategoryRepository->getCategory($categoryId);
            return new JsonResponse($category, Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[ParamConverter('request', converter: 'fos_rest.request_body')]
    public function update(string $id, UpdateCategoryRequest $request) : JsonResponse
    {
        try {
            $categoryId = new CategoryId($id);
            $this->commandBus->dispatch(new UpdateCategoryCommand($categoryId, $request->name()));
            $category = $this->doctrineCategoryRepository->getCategory($categoryId);
            return new JsonResponse($category, Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function delete(string $id) : JsonResponse
    {
        try {
            $categoryId = new CategoryId($id);
            $this->commandBus->dispatch(new DeleteCategoryCommand($categoryId));
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}