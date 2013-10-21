<?php

namespace Jobeet\Bundle\FinderBundle\DependencyInjection\Compiler;

use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class CreatePersistenceSessionsPassTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_should_do_nothing_if_no_doctrine_connection_is_registered()
    {
        $containerBuilder = new ContainerBuilder();

        $pass = new CreatePersistenceSessionsPass();
        $pass->process($containerBuilder);

        $this->assertEmpty($containerBuilder->getDefinitions());
    }
}