<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 09:57
 */

namespace Zf2Basket\Storage;


interface StorageAdapterInterface
{
    const CONFIG_NAME = 'name';

    /**
     * StorageAdapterInterface constructor.
     * @param $identity the unique identifier
     * @param $config and array of configurations
     */
    function __construct($identity, $config);

    /**
     * @param Container $basketContainer
     * @return $this
     */
    function put(Container $basketContainer);

    /**
     * @return Container
     */
    function pull();

    /**
     * @return this
     */
    function delete();
}