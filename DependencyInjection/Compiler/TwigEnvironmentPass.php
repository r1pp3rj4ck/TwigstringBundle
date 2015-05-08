<?php

namespace LK\TwigstringBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds tagged twig.extension and twigstring.extension services to twigstring service.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TwigEnvironmentPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('twig2')) {
            return;
        }

        $definition = $container->getDefinition('twig2');

        // Extensions must always be registered before everything else.
        // For instance, global variable definitions must be registered
        // afterward. If not, the globals from the extensions will never
        // be registered.
        $calls = $definition->getMethodCalls();
        $definition->setMethodCalls(array());
        if ($container->getParameter('twigstring.load_twig_extensions') === true) {
            foreach ($container->findTaggedServiceIds('twig.extension') as $id => $attributes) {
                $definition->addMethodCall('addExtension', array(new Reference($id)));
            }
        }
        foreach ($container->findTaggedServiceIds('twigstring.extension') as $id => $attributes) {
                $definition->addMethodCall('addExtension', array(new Reference($id)));
            }
        $definition->setMethodCalls(array_merge($definition->getMethodCalls(), $calls));
    }
}
