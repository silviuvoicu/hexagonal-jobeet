<?php

namespace Jobeet\Finder\Application\UseCase;

class ShowCategory
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param CategoryRepository $categoryRepository
     */
    public function __construct($categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute($name)
    {
        return $this->categoryRepository->findOneByName($name);
    }
}