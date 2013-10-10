<?php

namespace Jobeet\Bundle\FinderBundle;

use Jobeet\Bundle\FinderBundle\DependencyInjection\Compiler\JobeetFinderRegisterMappingsPass;
use Symfony\Bridge\Doctrine\DependencyInjection\CompilerPass\RegisterMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JobeetFinderBundle extends Bundle
{
}
