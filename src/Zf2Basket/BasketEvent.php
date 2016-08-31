<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 05/08/2016
 * Time: 12:31
 */

namespace Zf2Basket;

use Zend\EventManager\Event;

class BasketEvent extends Event
{

    const EVENT_INIT = 'init';
    const EVENT_ADD_ITEM = 'addItem';
    const EVENT_REMOVE_ITEM = 'removeItem';
    const EVENT_CLEAR_ITEM = 'clearItem';
    const EVENT_CLEAR_ITEMS = 'clearItems';
    const EVENT_ADD_DISCOUNT = 'addDiscount';
    const EVENT_REMOVE_DISCOUNT = 'removeDiscount';
    const EVENT_CLEAR_DISCOUNTS = 'clearDiscounts';

}