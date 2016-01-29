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
    public function exists($name)
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheKey($name)
    {
        return $name;
    }

    /**
     * {@inheritdoc}
     */
    public function isFresh($name, $time)
    {
        return true;
    }

}
