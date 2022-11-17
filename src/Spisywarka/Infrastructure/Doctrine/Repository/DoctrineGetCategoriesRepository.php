<?php declare(strict_types=1);

namespace Spisywarka\Infrastructure\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Spisywarka\Domain\Model\Category;
use Spisywarka\Domain\Model\CategoryId;

class DoctrineGetCategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $manager)
    {
        parent::__construct($manager, Category::class);
    }

    public function getCategory(CategoryId $categoryId): ?Category
    {
        if ($category = $this->find($categoryId)) {
            return $category;
        }

        //throw new CategoryNotFoundException('Category not found');
        return null;
    }
}