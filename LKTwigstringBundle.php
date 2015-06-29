<?php

/*
 * This file is part of the TwigString bundle
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LK\TwigstringBundle;

use LK\TwigstringBundle\DependencyInjection\Compiler\TwigstringEnvironmentPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class LKTwigstringBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new TwigstringEnvironmentPass());
    }
}
