<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 09:57
 */

namespace Basket\Storage;


interface StorageAdapterInterface
{
    const CONFIG_NAME = 'name';

    function __construct($identity, $config);

    function put(Container $basketContainer);

    function pull();

    function delete();
}