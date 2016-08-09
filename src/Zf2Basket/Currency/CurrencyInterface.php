<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 09/08/2016
 * Time: 17:38
 */

namespace Zf2Basket\Currency;


interface CurrencyInterface
{
    function getDescriptive($number);

    function getName();

    function getFractional();

    function getFormatted($number);
}