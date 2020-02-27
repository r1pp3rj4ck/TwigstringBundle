<?php

/*
 * This file is part of the TwigString bundle
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LK\TwigstringBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use LK\TwigstringBundle\DependencyInjection\Compiler\TwigEnvironmentPass;

class LKTwigstringBundle extends Bundle
{
	/**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new TwigEnvironmentPass());
    }
}
