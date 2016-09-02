<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 01/09/2016
 * Time: 11:59
 */

namespace Zf2Basket\Discount\Decorator;


abstract class AbstractDecorator implements DecoratorInterface
{

    /**
     * @var string
     */
    private $error;

    /**
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param string $error
     *
     * @return $this
     */
    public function setError($error)
    {
        $this->error = $error;
        return $this;
    }
}