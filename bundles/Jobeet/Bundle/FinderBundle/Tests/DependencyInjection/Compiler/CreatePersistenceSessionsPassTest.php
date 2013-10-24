<?php

namespace Jobeet\Bundle\FinderBundle\DependencyInjection\Compiler;

use PHPUnit_Framework_TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

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

    /**
     * @test
     * @dataProvider entityManagersDataProvider
     */
    public function it_should_create_the_persistence_session_for_the_default_doctrine_connection($entityManagerName)
    {
        $containerBuilder = new ContainerBuilder();

        $fakeEntityManagers = [
            'default' => sprintf('doctrine.orm.%s_entity_manager', 'default'),
            'em1' => sprintf('doctrine.orm.%s_entity_manager', 'em1'),
            'em2' => sprintf('doctrine.orm.%s_entity_manager', 'em2')
        ];

        $containerBuilder->setParameter('doctrine.entity_managers', $fakeEntityManagers);

        foreach ($fakeEntityManagers as $fakeEntityManager) {
            $containerBuilder->addDefinitions([
                $fakeEntityManager => new Definition()
            ]);
        }

        $pass = new CreatePersistenceSessionsPass();
        $pass->process($containerBuilder);

        foreach ($fakeEntityManagers as $fakeName => $fakeEntityManager) {
            $this->assertTrue($containerBuilder->has(sprintf('jobeet.common.port.adapter.persistence.doctrine.session.%s_session', $fakeName)));

            $definition = $containerBuilder->findDefinition(sprintf('jobeet.common.port.adapter.persistence.doctrine.session.%s_session', $fakeName));

            $this->assertEquals('Jobeet\Common\Port\Adapter\Persistence\Doctrine\DoctrineSession', $definition->getClass());
            $this->assertEquals($containerBuilder->findDefinition($fakeEntityManager), $definition->getArgument(0));
        }

    }

    public function entityManagersDataProvider()
    {
        return [
            ['default'],
            ['em1'],
            ['em2']
        ];
    }
}