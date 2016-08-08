<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Zf2Basket\Storage\Adapter' => 'Zf2Basket\Storage\Factory\CookieFactory',
            'Zf2Basket\Zf2Basket' => 'Zf2Basket\Zf2BasketFactory'
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
