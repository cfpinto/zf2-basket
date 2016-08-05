<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Basket\Storage\Adapter' => 'Basket\Storage\Factory\CookieFactory',
            'Basket\Basket' => 'Basket\BasketFactory'
        ),
    ),
    'storage_adapter' => array(
        //TODO: Need to include ZendFramework/Db in the dependencies
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
