<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 11:41
 */

namespace Zf2Basket\Administration\UnitedKingdom;


use Zf2Basket\Tax\AbstractTax;

class Vat extends AbstractTax
{
    protected $name = 'VAT';

    protected $rate = 23;

}