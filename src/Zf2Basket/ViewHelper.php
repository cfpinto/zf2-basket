<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 13/09/2016
 * Time: 09:19
 */

namespace Zf2Basket;

use Zend\View\Helper\AbstractHelper;

class ViewHelper extends AbstractHelper
{
    /**
     * @var Zf2Basket
     */
    private $basket;

    function __construct(Zf2Basket $basket)
    {
        $this->basket = $basket;
    }

    function __invoke()
    {
        return $this->basket;
    }

    function __call($name, $arguments)
    {
        return call_user_func_array([$this->basket, $name], $arguments);
    }
}