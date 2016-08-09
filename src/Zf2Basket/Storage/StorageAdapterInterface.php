<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 04/08/2016
 * Time: 09:57
 */

namespace Zf2Basket\Storage;


interface StorageAdapterInterface
{
    const CONFIG_NAME = 'name';

    /**
     * StorageAdapterInterface constructor.
     * @param integer $identity the unique identifier
     * @param array $config an array of configurations
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
     * @return $this
     */
    function delete();
}