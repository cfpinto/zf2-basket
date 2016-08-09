<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 14:16
 */

namespace Zf2Basket\Administration\UnitedStates;


use Zf2Basket\Currency\AbstractCurrency;

class Dollar extends AbstractCurrency
{
    protected $name = 'Dollar';

    protected $fractional = 'Cent';

    protected $decimalMark = '.';

    protected $thousandsMark = ',';

    protected $symbol = '$';

    protected $decimals = 2;
}