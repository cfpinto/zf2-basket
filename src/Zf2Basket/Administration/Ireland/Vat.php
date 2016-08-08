<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 11:41
 */

namespace Zf2Basket\Administration\Ireland;


use Zf2Basket\Tax\AbstractTax;

class Vat extends AbstractTax
{
    protected $name = 'VAT';

    protected $rate = 23;

}