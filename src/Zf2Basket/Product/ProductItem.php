<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 05/08/2016
 * Time: 16:33
 */

namespace Zf2Basket\Product;


class ProductItem extends AbstractProduct
{

    /**
     * @return boolean
     */
    public function isTaxable()
    {
        return true;
    }

    /**
     * @return boolean
     */
    public function hasOwnTax()
    {
        return ($this->getTax() !== null);
    }
}