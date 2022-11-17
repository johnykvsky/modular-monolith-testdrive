<?php

declare(strict_types=1);

namespace Spisywarka\Infrastructure\Symfony\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Spisywarka\Application\Helper\Polyfill;
use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineGetItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ItemsController extends AbstractController
{
    private DoctrineGetItemsRepository $doctrineGetItemsRepository;
    private PaginatorInterface $paginator;

    public function __construct(
        DoctrineGetItemsRepository $doctrineGetItemsRepository,
        PaginatorInterface $paginator
    ) {
        $this->doctrineGetItemsRepository = $doctrineGetItemsRepository;
        $this->paginator = $paginator;
    }

    public function index() : JsonResponse
    {
        $request = Request::createFromGlobals();
        $searchQuery = Polyfill::filter($request->query->get('search', ''));

        $items = $this->paginator->paginate(
            $this->doctrineGetItemsRepository->listAllItems($searchQuery),
            $request->query->getInt('page', 1),
            10
        );

        return new JsonResponse($items->getItems());
    }

    public function tag() : JsonResponse
    {
        $request = Request::createFromGlobals();
        $tag = Polyfill::filter($request->query->get('tag', ''));

        $items = $this->paginator->paginate(
            $this->doctrineGetItemsRepository->listItemsByTag($tag),
            $request->query->getInt('page', 1),
            10
        );

        return new JsonResponse($items->getItems());
    }

    public function category(string $id) : JsonResponse
    {
        $request = Request::createFromGlobals();

        $items = $this->paginator->paginate(
            $this->doctrineGetItemsRepository->listAllItemsInCategory(new CategoryId($id)),
            $request->query->getInt('page', 1),
            10
        );

        return new JsonResponse($items->getItems());
    }
}