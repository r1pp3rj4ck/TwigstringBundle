<?php

/*
 * This file is part of the TwigString bundle
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LK\TwigstringBundle\Loader;

class StringLoader implements \Twig_LoaderInterface
{
    public function load($name)
    {
        return new $name;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getSource($name)
    {
        return $name;
    }

    /**
     * {@inheritdoc}
     */
    public function getSourceContext($name)
    {
        return new \Twig_Source($name, md5($name));
    }

    /**
     * {@inheritdoc}
     */
    public function exists($name)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey($name)
    {
        if (preg_match('/^[a-f0-9]{32}$/', $name) === 1) {
            return $name;
        } else {
            return md5($name);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isFresh($name, $time)
    {
        return true;
    }

}
