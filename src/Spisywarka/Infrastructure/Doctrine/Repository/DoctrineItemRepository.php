<?php

namespace Spisywarka\Infrastructure\Doctrine\Repository;

use Spisywarka\Domain\Model\Item;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Spisywarka\Domain\Model\ItemId;
use Spisywarka\Infrastructure\Doctrine\Repository\Exception\ItemNotFoundException;

class DoctrineItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Item::class);
    }

    public function getItem(ItemId $itemId): Item
    {
        if ($item = $this->find($itemId)) {
            return $item;
        }

        throw new ItemNotFoundException('Item not found');
    }

    public function findItemBySlug(string $slug): ?Item
    {
        if ($item = $this->findOneBy(['slug' => $slug])) {
            return $item;
        }

        return null;
    }

    public function save(Item $item): void
    {
        $em = $this->getEntityManager();
        $em->persist($item);
        $em->flush();
    }

    public function remove(Item $item): void
    {
        $em = $this->getEntityManager();
        $em->remove($item);
        $em->flush();
    }
}
