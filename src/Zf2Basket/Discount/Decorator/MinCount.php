<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 14:53
 */

namespace Zf2Basket\Discount\Decorator;


class MinCount extends AbstractProductDecorator
{

    private $minCount;

    /**
     * @return mixed
     */
    public function getMinCount()
    {
        return $this->minCount;
    }

    /**
     * @param mixed $minCount
     */
    public function setMinCount($minCount)
    {
        $this->minCount = $minCount;
    }

    function isValid()
    {
        if ($this->container->count($this->product) >= $this->minCount) {
            return true;
        }

        return false;
    }
}