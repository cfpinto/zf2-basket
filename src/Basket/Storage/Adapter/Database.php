<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 10:14
 */

namespace Basket\Storage\Adapter;


use Basket\Storage\Container;
use Basket\Storage\StorageAdapterInterface;

class Database implements StorageAdapterInterface
{

    public function __construct($identity, $config)
    {
    }

    function delete()
    {
        // TODO: Implement delete() method.
    }

    function put(Container $basketContainer)
    {
        // TODO: Implement put() method.
    }

    function pull()
    {
        // TODO: Implement pull() method.
    }
}