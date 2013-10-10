<?php

namespace Jobeet\Bundle\FinderBundle\DataFixtures\ORM;

use DateTime;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Jobeet\Finder\Domain\Model\Job\Job;

class LoadJobData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param \Doctrine\Common\Persistence\ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $sensioLabsJob = new Job(
            $this->getReference('programming'),
            'Sensio Labs',
            'You\'ve already developed websites with symfony and you want to work with Open-Source technologies. You have a minimum of 3 years experience in web development with PHP or Java and you wish to participate to development of Web 2.0 sites using the best frameworks available.',
            'job@example.com',
            new DateTime('2010-10-10'),
            'Send your resume to fabien.potencier [at] sensio.com',
            'Paris, France',
            'full-time',
            'sensio-labs.gif',
            'http://www.sensiolabs.com/',
            'Web Developer',
            true,
            false,
            'job_sensio_labs'
        );

        $manager->persist($sensioLabsJob);
        $manager->flush();

        $this->addReference('job_sensio_labs', $sensioLabsJob);

        $extremeSensioJob = new Job(
            $this->getReference('design'),
            'Extrem Sensio',
            'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in.',
            'job@example.com',
            new DateTime('2010-10-10'),
            'Send your resume to fabien.potencier [at] sensio.com',
            'Paris, France',
            'part-time',
            'extreme-sensio.gif',
            'http://www.extreme-sensio.com/',
            'Web Designer',
            true,
            true,
            'job_extreme_sensio'
        );

        $manager->persist($extremeSensioJob);
        $manager->flush();

        $this->addReference('job_extreme_sensio', $extremeSensioJob);
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    function getOrder()
    {
        return 2;
    }
}