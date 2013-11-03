<?php

namespace Jobeet\Bundle\FinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CategoryController extends Controller
{
    /**
     * @Route("/category/{name}", name = "category")
     * @Template()
     */
    public function showAction($name)
    {
        $category = $this->get('jobeet.finder.application.use_case.show_category')->execute(ucfirst($name));

        if (!$category) {
            throw $this->createNotFoundException(sprintf('Category "%s" not found', $name));
        }

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $category->activeJobs(),
            $this->getRequest()->query->get('page', 1),
            20
        );

        return [
            'category' => $category,
            'pagination' => $pagination
        ];
    }

}
