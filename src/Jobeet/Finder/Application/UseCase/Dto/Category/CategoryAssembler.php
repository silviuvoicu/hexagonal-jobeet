<?php

namespace Jobeet\Finder\Application\UseCase\Dto\Category;

use Jobeet\Finder\Application\UseCase\Dto\Category\Category as CategoryDto;
use Jobeet\Finder\Domain\Model\Category\Category as CategoryEntity;

class CategoryAssembler
{
    /**
     * From a given Category DTO builds a new Category Entity
     *
     * @param CategoryDto $categoryDto
     *
     * @return Category
     */
    public function assemble($categoryDto)
    {
        return new CategoryEntity($categoryDto->getName());
    }
}