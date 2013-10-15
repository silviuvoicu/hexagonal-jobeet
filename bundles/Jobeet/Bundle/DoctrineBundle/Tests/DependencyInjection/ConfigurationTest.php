<?php

namespace Jobeet\Bundle\DoctrineBundle\Tests\DependencyInjection;

use Jobeet\Bundle\DoctrineBundle\DependencyInjection\Configuration;
use Matthias\SymfonyConfigTest\PhpUnit\AbstractConfigurationTestCase;

class ConfigurationTest extends AbstractConfigurationTestCase
{
    /**
     * Return the instance of ConfigurationInterface that should be used by the
     * Configuration-specific assertions in this test-case
     *
     * @return \Symfony\Component\Config\Definition\ConfigurationInterface
     */
    protected function getConfiguration()
    {
        return new Configuration();
    }
    
    /**
     * @test
     */
    public function it_should_not_flush_entity_managers_on_terminate_by_default()
    {
        $this->assertProcessedConfigurationEquals(
            [],
            [
                'flush_entity_managers_on_terminate' => false
            ]
        );
    }

    /**
     * @test
     */
    public function it_should_have_a_boolean_node_to_enable_or_disable_doctrine_entity_managers_on_kernel_terminate()
    {
        $this->assertProcessedConfigurationEquals(
            [
                [
                    'flush_entity_managers_on_terminate' => true
                ]
            ],
            [
                'flush_entity_managers_on_terminate' => true
            ]
        );
    }
}
