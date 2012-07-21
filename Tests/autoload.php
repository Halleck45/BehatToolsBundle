<?php

use Symfony\Component\ClassLoader\UniversalClassLoader;
use Doctrine\Common\Annotations\AnnotationRegistry;

$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Symfony'          => array(__DIR__.'/../vendor/symfony/src', __DIR__.'/../vendor/bundles'),
    'Sensio'           => __DIR__.'/../vendor/bundles',
    'JMS'              => __DIR__.'/../vendor/bundles',
//    'Doctrine\\Common' => __DIR__.'/../vendor/doctrine-common/lib',
//    'Doctrine\\DBAL'   => __DIR__.'/../vendor/doctrine-dbal/lib',
//    'Doctrine'         => __DIR__.'/../vendor/doctrine/lib',
    'Monolog'          => __DIR__.'/../vendor/monolog/src',
    'Assetic'          => __DIR__.'/../vendor/assetic/src',
    'Metadata'         => __DIR__.'/../vendor/metadata/src',
    'Behat\\Gherkin'   => __DIR__.'/../vendor/behat/gherkin/src',
));

$loader->registerNamespaceFallbacks(array(
    __DIR__.'/../src',
));
$loader->register();
