TwigstringBundle information & howto
====================================

This Symfony2 Bundle adds the possibility to render strings instead of files with the Symfony2 native Twig templating engine.
The Bundle adds an additional service named `twigstring`. It is used the same way as the original templating service.
The only difference is that the first argument of the method `render(<string>, [<array])` is a string to parse instead of a template file.

The bundles supports variable output, conditions, loops and rendering of an controller. It does NOT support including templates, yet. It would interpret the template name as twigstring.

One example usage scenario is to load templates from the database instead of using files.

Extension ideas:

* option to include templates
* add a black-/whitelist for allowed allowed twig tags

## Installation


### 1. Register the bundle in composer

You need to add it to your composer.json requirements:
``` js
{
    "require": {
         "zeliard91/twigstring-bundle": "~1.0"
    }
}
```

### 2. Downloading the bundle from packagist

Install it by running the following command:

    $ ./composer.phar update zeliard91/twigstring-bundle
    
### 3. Registering the bundle in the kernel

``` php
<?php
// app/AppKernel.php

public function registerBundles() {
    $bundles = array(
        // ...
        new LK\TwigstringBundle\LKTwigstringBundle(),
        // ...
    );
}
```

### 4. Registering the bundle in the configuration

``` yaml
# app/config/config.yml
lk_twigstring:
    # Decide if you want that all registered twig extensions must be loaded
    load_twig_extensions: true # (default to true)
```

### 5. Add additional extensions you are in need of (optional)

``` yaml
# app/config/services.yml
services:
    twigstring.extension.foo:
        class: Foo\BarBundle\Twig\FooBarExtension
        tags:
            - { name: twigstring.extension }
```

For a list of available extensions see [fabpot/Twig-extensions](https://github.com/fabpot/Twig-extensions) or create one on your own with [Symfony Cookbook](http://symfony.com/doc/current/cookbook/templating/twig_extension.html) and [twig doc](http://twig.sensiolabs.org/doc/advanced.html#creating-an-extension).

## Usage

``` php
// set example parameter
$vars = array('var'=>'x');

// get twigstring service
$tpl_engine = $this->get('twigstring');

// render example string
$vars['test'] = 'u ' . $tpl_engine->render('v {{ var }} {% if var is defined %} y {% endif %} z{% for i in 1..5 %} {{ i }}{% endfor %}', $vars);
```

or use the short way:

``` php
// set example parameter
$vars = array('var'=>'x');

// render example string
$vars['test'] = 'u ' . $this->get('twigstring')->render('v {{ var }} {% if var is defined %} y {% endif %} z{% for i in 1..5 %} {{ i }}{% endfor %}', $vars);
```

### Example output:

    u v x y z

## License

The bundle is licensed under MIT license. For full license see [LICENSE](https://github.com/zeliard91/TwigstringBundle/blob/master/LICENSE) file

### Authors
LarsK (Lars Krüger), cordoval (Luis Cordova), r1pp3rj4ck (Attila Bukor), zeliard91 (Damien Matabon)
