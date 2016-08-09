<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 11:41
 */

namespace Zf2Basket\Tax;


abstract class AbstractTax
{
    protected $rate = 0;

    protected $name = 'Tax';

    final function getRate()
    {
        return $this->rate;
    }

    final function getName()
    {
        return $this->name;
    }

    final function getDecimal()
    {
        return round($this->rate / 100, 2);
    }

    final function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    final function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }
}