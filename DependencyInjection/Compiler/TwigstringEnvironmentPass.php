<?php
namespace LK\TwigstringBundle\DependencyInjection\Compiler;

use Symfony\Bundle\TwigBundle\DependencyInjection\Compiler\TwigEnvironmentPass;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds tagged twig.extension services to twig2 service
 *
 * This is needed to be able to use twig extensions from YAML configuration
 *
 * @see TwigEnvironmentPass
 */
class TwigstringEnvironmentPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('twigstring')) {
            // LKTwigstringBundle not installed
            return;
        }

        $definition = $container->getDefinition('twigstring');

        // Extensions must always be registered before everything else.
        // For instance, global variable definitions must be registered
        // afterward. If not, the globals from the extensions will never
        // be registered.
        $calls = $definition->getMethodCalls();
        $definition->setMethodCalls(array());
        foreach (array_keys($container->findTaggedServiceIds('twigstring.extension')) as $id) {
            $definition->addMethodCall('addExtension', array(new Reference($id)));
        }

        $definition->setMethodCalls(array_merge($definition->getMethodCalls(), $calls));
    }
}
