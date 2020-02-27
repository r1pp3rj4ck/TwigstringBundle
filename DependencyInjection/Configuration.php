<?php

/*
 * This file is part of the TwigString bundle
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LK\TwigstringBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * RenderString structure
 *
 * @author LaKrue <symfony@lakrue.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configration tree builder
     */
    public function getConfigTreeBuilder()
    {
    	$treeBuilder = new TreeBuilder();
    	$rootNode = $treeBuilder->root('lk_twigstring');

        $rootNode
            ->children()->booleanNode('load_twig_extensions')->defaultValue(true)->end()
        ;

		return $treeBuilder;
    }
}
