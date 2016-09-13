<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Zf2Basket\Storage\Adapter' => 'Zf2Basket\Storage\Factory\CookieFactory',
            \Zf2Basket\Zf2Basket::class => \Zf2Basket\Zf2BasketFactory::class
        ),
        'alias' => array(
            \Zf2Basket\Zf2Basket::alias => \Zf2Basket\Zf2Basket::class
        ),
    ),
    'controller_plugins' => array(
        'invokables' => array(
            \Zf2Basket\Zf2Basket::alias => \Zf2Basket\ControllerPlugin::class,
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            \Zf2Basket\Zf2Basket::alias => \Zf2Basket\ViewHelperFactory::class,
        ),
    ),
    'storage_adapter' => array(
        'database' => array(
            'driver' => 'Pdo_Mysql',
            'dsn' => 'mysql:dbname=paug;host=localhost',
            'username' => 'username',
            'password' => 'password',
            'driver_options' => array(1002 => "SET NAMES 'UTF8'"),
        ),
        'cookie' => array(
            'name' => 'zend_basket',
        ),
    ),
);
