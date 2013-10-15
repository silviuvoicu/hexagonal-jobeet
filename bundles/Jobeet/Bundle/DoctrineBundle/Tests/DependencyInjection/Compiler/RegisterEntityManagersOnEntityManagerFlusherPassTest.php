<?php

namespace Jobeet\Bundle\DoctrineBundle\Tests\DependencyInjection\Compiler;

use Jobeet\Bundle\DoctrineBundle\DependencyInjection\Compiler\RegisterEntityManagersOnEntityManagerFlusherPass;
use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class RegisterEntityManagersOnEntityManagerFlusherPassTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RegisterEntityManagersOnEntityManagerFlusherPass
     */
    private $compilerPass;

    protected function setUp()
    {
        $this->compilerPass = new RegisterEntityManagersOnEntityManagerFlusherPass();
    }

    protected function tearDown()
    {
        $this->compilerPass = null;
    }

    /**
     * @test
     */
    public function it_should_remove_the_event_listener_if_no_entity_managers_registered()
    {
        $container = new ContainerBuilder();
        $container
            ->addDefinitions([
                'jobeet_doctrine.event_listener.entity_manager_flusher' => new Definition()
            ])
        ;

        $this->compilerPass->process($container);

        $this->assertFalse($container->hasDefinition('jobeet_doctrine.event_listener.entity_manager_flusher'));
    }

    /**
     * @test
     */
    public function it_should_add_entity_managers_to_the_event_listener()
    {
        $container = new ContainerBuilder();
        $container->addDefinitions(
            [
                'jobeet_doctrine.event_listener.entity_manager_flusher' => new Definition(),
                'doctrine.orm.em1_entity_manager' => new Definition(),
                'doctrine.orm.em2_entity_manager' => new Definition()
            ]
        );

        $container->setParameter('doctrine.entity_managers', ['em1' => 'doctrine.orm.em1_entity_manager', 'em2' => 'doctrine.orm.em2_entity_manager']);

        $this->compilerPass->process($container);

        $definition = $container->getDefinition('jobeet_doctrine.event_listener.entity_manager_flusher');
        $this->assertTrue($definition->hasMethodCall('registerEntityManagers'));
        $this->assertCount(2, $definition->getMethodCalls()[0][1][0]);
    }
}