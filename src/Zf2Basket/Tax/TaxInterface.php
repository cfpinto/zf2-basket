<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 09/08/2016
 * Time: 17:23
 */

namespace Zf2Basket\Tax;


interface TaxInterface
{
    function getRate();

    function getName();

    function getDecimal();

    function setName($name);

    function setRate($rate);
}