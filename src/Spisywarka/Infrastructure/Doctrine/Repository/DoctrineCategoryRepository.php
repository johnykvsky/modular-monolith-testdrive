<?php

namespace Spisywarka\Infrastructure\Doctrine\Repository;

use Spisywarka\Domain\Model\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Spisywarka\Domain\Model\CategoryId;
use Spisywarka\Infrastructure\Doctrine\Repository\Exception\CategoryNotFoundException;

class DoctrineCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Category::class);
    }

    public function getCategory(CategoryId $categoryId): Category
    {
        if ($category = $this->find($categoryId)) {
            return $category;
        }

        throw new CategoryNotFoundException('Category not found');
    }

    public function save(Category $category): void
    {
        $em = $this->getEntityManager();
        $em->persist($category);
        $em->flush();
    }

    public function remove(Category $category): void
    {
        $em = $this->getEntityManager();
        $em->remove($category);
        $em->flush();
    }
}
