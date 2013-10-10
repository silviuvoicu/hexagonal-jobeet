<?php

namespace Jobeet\Bundle\FinderBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Jobeet\Finder\Domain\Model\Category\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        /**
         * JobeetCategory:
        manager:
        name: Manager
        administrator:
        name: Administrator
         */

        $designCategory = new Category('Design');
        $manager->persist($designCategory);
        $manager->flush();

        $this->addReference('design', $designCategory);

        $programmingCategory = new Category('Programming');
        $manager->persist($programmingCategory);
        $manager->flush();

        $this->addReference('programming', $programmingCategory);

        $managerCategory = new Category('Manager');
        $manager->persist($managerCategory);
        $manager->flush();

        $this->addReference('manager', $managerCategory);

        $administratorCategory = new Category('Administrator');
        $manager->persist($administratorCategory);
        $manager->flush();

        $this->addReference('administrator', $administratorCategory);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 1;
    }
}