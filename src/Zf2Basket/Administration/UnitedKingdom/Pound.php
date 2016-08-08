<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 08/08/2016
 * Time: 14:16
 */

namespace Zf2Basket\Administration\UnitedKingdom;


use Zf2Basket\Currency\AbstractCurrency;

class Pound extends AbstractCurrency
{
    protected $name = 'Pound';

    protected $fractional = 'Pence';

    protected $decimalMark = '.';

    protected $thousandsMark = ',';

    protected $symbol = '£';

    protected $decimals = 2;
}