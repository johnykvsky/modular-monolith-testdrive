<?php

declare(strict_types=1);

namespace Spisywarka\Infrastructure\Symfony\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Spisywarka\Application\Command\CreateItemCommand;
use Spisywarka\Application\Command\DeleteItemCommand;
use Spisywarka\Application\Command\UpdateItemCommand;
use Spisywarka\Application\Request\CreateItemRequest;
use Spisywarka\Application\Request\UpdateItemRequest;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Spisywarka\Domain\Model\ItemId;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class ItemController extends AbstractController
{
    private DoctrineItemRepository $doctrineItemRepository;
    private MessageBusInterface $commandBus;

    public function __construct(
        DoctrineItemRepository $doctrineItemRepository,
        MessageBusInterface $commandBus
    )
    {
        $this->doctrineItemRepository = $doctrineItemRepository;
        $this->commandBus = $commandBus;
    }

    #[ParamConverter('request', converter: 'fos_rest.request_body')]
    public function create(CreateItemRequest $request) : JsonResponse
    {
        try {
            $itemId = new ItemId(Uuid::uuid4()->toString());
            $this->commandBus->dispatch(
                new CreateItemCommand(
                    $itemId,
                    $request->name(),
                    $request->parentId(),
                    $request->categoryId(),
                    $request->author(),
                    $request->originalTitle(),
                    $request->description(),
                    $request->content(),
                    $request->partsCount(),
                    $request->mediumType(),
                    $request->firstReleaseDate(),
                    $request->releaseDate(),
                    $request->addons(),
                    $request->position(),
                    $request->translatedBy(),
                    $request->masteredBy(),
                    $request->coverType(),
                    $request->editionNumber(),
                    $request->infoUrl(),
                    $request->imageUrl(),
                    $request->tags()
                )
            );

            $item = $this->doctrineItemRepository->getItem($itemId);
            return new JsonResponse($item, Response::HTTP_CREATED);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    #[ParamConverter('request', converter: 'fos_rest.request_body')]
    public function update(string $id, UpdateItemRequest $request) : JsonResponse
    {
        try {
            $itemId = new ItemId($id);
            $this->commandBus->dispatch(new UpdateItemCommand(
                                            $itemId,
                                            $request->name(),
                                            $request->parentId(),
                                            $request->categoryId(),
                                            $request->author(),
                                            $request->originalTitle(),
                                            $request->description(),
                                            $request->content(),
                                            $request->partsCount(),
                                            $request->mediumType(),
                                            $request->firstReleaseDate(),
                                            $request->releaseDate(),
                                            $request->addons(),
                                            $request->position(),
                                            $request->translatedBy(),
                                            $request->masteredBy(),
                                            $request->coverType(),
                                            $request->editionNumber(),
                                            $request->infoUrl(),
                                            $request->imageUrl(),
                                            $request->tags()
                                        ));

            $item = $this->doctrineItemRepository->getItem($itemId);
            return new JsonResponse($item, Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }

    public function delete(string $id) : JsonResponse
    {
        try {
            $itemId = new ItemId($id);
            $this->commandBus->dispatch(new DeleteItemCommand($itemId));
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        } catch (\Throwable $e) {
            return new JsonResponse(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}