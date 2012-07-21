<?php
require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/bootstrap.php.cache';


$vendorDir = __DIR__.'/../vendor';

use Symfony\Component\ClassLoader\UniversalClassLoader;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony' => $vendorDir.'/symfony/src',
    'Hal\Bundle\BehatTools' => $vendorDir.'/../',
));
$loader->register();

spl_autoload_register(function($class) {
    $class = ltrim($class, '\\');
    if (0 === strpos($class, 'Hal\Bundle\BehatTools\\')) {
        $file = __DIR__.'/../'.str_replace('\\', '/', substr($class, strlen('Hal\Bundle\BehatTools\\'))).'.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});