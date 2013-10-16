<?php

namespace Jobeet\Finder\Port\Adapter\Persistence\Doctrine;

use Doctrine\ORM\EntityRepository;
use Jobeet\Finder\Domain\Model\Category\Category;

class DoctrineCategoryRepository extends EntityRepository
{
    /**
     * Persists a given category
     *
     * @param Category $category
     */
    public function persist($category)
    {
        $this->getEntityManager()->persist($category);
    }
}