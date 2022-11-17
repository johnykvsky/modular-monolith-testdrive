<?php declare(strict_types=1);

namespace Spisywarka\Infrastructure\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;
use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Domain\Model\Item;
use Spisywarka\Domain\Model\ItemId;

class DoctrineGetItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Item::class);
    }

    public function getItem(ItemId $itemId): ?Item
    {
        if ($item = $this->find($itemId)) {
            return $item;
        }

        return null;
    }

    public function getItems(): array
    {
        return $this->findAll();
    }

    public function listAllItems(?string $searchQuery = ''): Query
    {
        if (empty($searchQuery)) {
            return $this->createQueryBuilder('i')->orderBy('i.name' ,'ASC')->getQuery();
        }

        $qb = $this->createQueryBuilder('i');
        return $qb->where($qb->expr()->like('i.name', ':searchQuery'))
            ->orWhere($qb->expr()->like('i.author', ':searchQuery'))
            ->orWhere($qb->expr()->like('i.description', ':searchQuery'))
            ->orWhere($qb->expr()->like('i.originalTitle', ':searchQuery'))
            ->orderBy('i.name' ,'ASC')
            ->setParameters([
                                'searchQuery' => "%{$searchQuery}%",
                            ])
            ->getQuery();
    }

    public function listItemsByTag(?string $tag = ''): Query
    {
        if (empty($tag)) {
            return $this->createQueryBuilder('i')->orderBy('i.name' ,'ASC')->getQuery();
        }

        $qb = $this->createQueryBuilder('i');
        return $qb->where($qb->expr()->like('i.tags', ':tag'))
            ->orderBy('i.name' ,'ASC')
            ->setParameters([
                                'tag' => "%|{$tag}|%",
                            ])
            ->getQuery();
    }

    public function listAllItemsInCategory(CategoryId $categoryId): Query
    {
        $qb = $this->createQueryBuilder('i');
        return $qb->where('i.category = :category')
            ->orderBy('i.name' ,'ASC')
            ->setParameters([
                                'category' => $categoryId->value(),
                            ])
            ->getQuery();
    }
}