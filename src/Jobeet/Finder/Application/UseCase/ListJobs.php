<?php

namespace Jobeet\Finder\Application\UseCase;

class ListJobs
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * Class constructor
     *
     * @param CategoryRepository $categoryRepository
     */
    public function __construct($categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute()
    {
        return $this->categoryRepository->findAll();
    }
}