<?php

declare(strict_types=1);

namespace Spisywarka\Infrastructure\Symfony\Controller;

//use Mohawk\Microblog\Microblog;
use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineGetCategoriesRepository;
use Spisywarka\Infrastructure\Doctrine\Repository\DoctrineGetItemsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Spisywarka\Domain\Model\Item;
use Spisywarka\Domain\Model\ItemId;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;

class HomeController extends AbstractController
{
    // private Microblog $microblog;
    private DoctrineGetItemsRepository $doctrineGetItemsRepository;

    // public function __construct(Microblog $microblog)
    // {
    //     $this->microblog = $microblog;
    // }
    private DoctrineGetCategoriesRepository $doctrineGetCategoriesRepository;
    private SluggerInterface $slugger;

    public function __construct(
        DoctrineGetItemsRepository $doctrineGetItemsRepository,
        DoctrineGetCategoriesRepository $doctrineGetCategoriesRepository,
        SluggerInterface $slugger
    )
    {
        $this->doctrineGetItemsRepository = $doctrineGetItemsRepository;
        $this->doctrineGetCategoriesRepository = $doctrineGetCategoriesRepository;
        $this->slugger = $slugger;
    }

    public function index(ParameterBagInterface $params) : Response
    {
        $someParam = $params->get('some.param');
        var_dump($someParam);

        $category = $this->doctrineGetCategoriesRepository->getCategory(
            new CategoryId('ef25bd21-bc73-4cae-b7b9-dc90f50a9808')
        );
//// persist
$id = Uuid::uuid4();
$name = 'name '.random_int(10,20);
$slug = $this->slugger->slug($name)->toString();
//$parent = $this->doctrineGetItemsRepository->getItem(new ItemId('2558d807-2f45-4621-8891-a69abab45f9d'));
$parent = null;
$item = new Item(new ItemId($id->toString()), $category,$name, $slug, $parent);
$this->doctrineGetItemsRepository->save($item);
//$em->persist($item);
//$em->flush();
//
//// retrieve
////$myItem = $em->find(Item::class, $id->toString());
////or
//$myItem = $em->find(Item::class, new ItemId($id->toString()));
//var_dump($myItem->id());
        //$myItem = $doctrineGetItemsRepository->find(new ItemId($id->toString()));
        $myItem = $this->doctrineGetItemsRepository->getItem($item->id());

        return new Response($myItem->id()->value().': '.$myItem->name());
    }
}