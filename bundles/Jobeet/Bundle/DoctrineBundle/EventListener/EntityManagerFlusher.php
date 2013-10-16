<?php

namespace Jobeet\Bundle\DoctrineBundle\EventListener;

use Doctrine\ORM\EntityManager;

class EntityManagerFlusher
{
    /**
     * @var array
     */
    private $entityManagers = [];

    /**
     * Performs the flush operation in all the registered entity managers
     */
    public function onTerminate()
    {
        array_map(
            function(EntityManager $em) {
                $em->flush();
            },
            $this->entityManagers
        );
    }

    /**
     * Registers a new EntityManager to be flushed
     *
     * @param array $entityManagers
     */
    public function registerEntityManagers(array $entityManagers)
    {
        foreach ($entityManagers as $entityManager) {
            $this->entityManagers[] = $entityManager;
        }
    }
}
