<?php

namespace Jobeet\Finder\Application\UseCase\Dto\Category;

use Jobeet\Finder\Application\UseCase\Dto\Category\Category as CategoryDto;
use Jobeet\Finder\Domain\Model\Category\Category as CategoryEntity;

class CategoryAssembler
{
    private $categoryRepository;

    /**
     * Class constructor
     *
     * @param $categoryRepository
     */
    public function __construct($categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * From a given Category DTO builds a new Category Entity
     *
     * @param CategoryDto $categoryDto
     *
     * @return Category
     */
    public function assemble($categoryDto)
    {
        if (null !== $categoryDto->getId()) {
            return $this->categoryRepository->find($categoryDto->getId());
        }

        return new CategoryEntity($categoryDto->getName());
    }
}