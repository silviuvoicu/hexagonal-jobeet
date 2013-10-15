<?php

namespace Jobeet\Bundle\DoctrineBundle;

use Jobeet\Bundle\DoctrineBundle\DependencyInjection\Compiler\RegisterEntityManagersOnEntityManagerFlusherPass;
use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class JobeetDoctrineBundleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_register_the_compiler_pass_responsible_to_add_entity_managers_to_the_event_listener()
    {
        $bundle = new JobeetDoctrineBundle();
        $container = new ContainerBuilder();

        $bundle->build($container);

        $passes = $container->getCompilerPassConfig()->getPasses();

        $found = false;
        foreach ($passes as $pass) {
            if ($pass instanceof RegisterEntityManagersOnEntityManagerFlusherPass) {
                $found = true;
                break;
            }
        }

        $this->assertTrue($found, '"RegisterEntityManagersOnEntityManagerFlusherPass not found in the current compiler passes');
    }
}