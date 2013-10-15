<?php

namespace Jobeet\Bundle\DoctrineBundle\Tests\DependencyInjection;

use Jobeet\Bundle\DoctrineBundle\DependencyInjection\JobeetDoctrineExtension;
use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class JobeetDoctrineExtensionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var JobeetDoctrineExtension
     */
    private $extension;

    /**
     * @var ContainerBuilder
     */
    private $container;

    protected function setUp()
    {
        $this->container = new ContainerBuilder();
        $this->extension = new JobeetDoctrineExtension();
    }

    protected function tearDown()
    {
        $this->container = $this->extension = null;
    }

    /**
     * Loads a given configuration array
     *
     * @param array $configs
     */
    private function load($configs)
    {
        $this->extension->load($configs, $this->container);
    }

    /**
     * @test
     */
    public function it_should_not_modify_any_service_definition_by_default()
    {
        $this->load([]);
        $this->assertFalse($this->container->hasDefinition('jobeet_doctrine.event_listener.entity_manager_flusher'));
    }

    /**
     * @test
     */
    public function it_should_register_the_event_listener_when_the_configuration_tells_to_flush_on_terminate()
    {
        $this->load(
            [
                [
                    'flush_entity_managers_on_terminate' => true
                ]
            ]
        );

        $this->assertTrue($this->container->hasDefinition('jobeet_doctrine.event_listener.entity_manager_flusher'));

        $definition = $this->container->getDefinition('jobeet_doctrine.event_listener.entity_manager_flusher');
        $this->assertTrue($definition->hasTag('kernel.event_listener'));
    }
}