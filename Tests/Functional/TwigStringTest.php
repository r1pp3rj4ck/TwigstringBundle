<?php
namespace Tests\Functional;

use LK\TwigstringBundle\LKTwigstringBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;

class TwigStringTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $kernel = new TwigEngineKernel('dev', true);
        $kernel->boot();

        $container = $kernel->getContainer();
        $content = $container->get('twigstring')->render('Hello {{ name }}', array('name' => 'Roger'));
        $this->assertEquals('Hello Roger', $content, 'Check simple var assigment');

        $content = $container->get('twigstring')->render('Hello {{ name | truncate(2) }}', array('name' => 'Roger'));
        $this->assertEquals('Hello Ro...', $content, 'Check simple var assigment + use of text extension');
    }

    protected function setUp()
    {
        $this->deleteTempDir();
    }

    protected function tearDown()
    {
        $this->deleteTempDir();
    }

    protected function deleteTempDir()
    {
        if (!file_exists($dir = sys_get_temp_dir().'/'.Kernel::VERSION.'/NoTemplatingEntryKernel')) {
            return;
        }

        $fs = new Filesystem();
        $fs->remove($dir);
    }
}


class TwigEngineKernel extends Kernel
{
    public function registerBundles()
    {
        return array(new FrameworkBundle(), new TwigBundle(), new LKTwigstringBundle());
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(function ($container) {
            $definitionTwigText = new Definition('Twig_Extensions_Extension_Text');
            $definitionTwigText->addTag('twig.extension');
            $container->setDefinition('twig.extension.text', $definitionTwigText);

            $container->loadFromExtension('framework', array(
                'secret' => '$ecret',
                'templating' => array(
                    'engines' => array('twig')
                ),
                'router' => array(
                    'resource' => __DIR__.'/Resources/routing.yml'
                )
            ));
        });
    }

    public function getCacheDir()
    {
        return sys_get_temp_dir().'/'.Kernel::VERSION.'/TwigEngineKernel/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return sys_get_temp_dir().'/'.Kernel::VERSION.'/TwigEngineKernel/logs';
    }
}
