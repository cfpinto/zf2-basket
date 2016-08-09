<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 11:41
 */

namespace Zf2Basket\Administration\Portugal;


use Zf2Basket\Tax\AbstractTax;

class Iva extends AbstractTax
{
    protected $name = 'IVA';

    protected $rate = 23;

}