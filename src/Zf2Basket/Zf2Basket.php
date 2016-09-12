<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 08/08/2016
 * Time: 15:12
 */

namespace Zf2Basket;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zf2Basket\Discount\DiscountInterface;
use Zf2Basket\Product\ProductInterface;


class Zf2Basket extends Basket implements EventManagerAwareInterface, ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    const alias = 'Basket';

    /**
     * @var EventManagerInterface
     */
    private $eventManager;

    function __construct(StorageAdapterInterface $adapter, Container $container)
    {
        return $this->setAdapter($adapter)
            ->setContainer($container);
    }

    /**
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }

    /**
     * @param EventManagerInterface $eventManager
     *
     * @return $this
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers([
            __CLASS__,
            get_class($this),
        ]);
        $this->eventManager = $eventManager;
        return $this;
    }

    /**
     * @return $this
     */
    public function init()
    {
        $result = parent::init();
        $this->eventManager->trigger(__FUNCTION__, $this, []);
        return $result;
    }

    /**
     * @param ProductInterface $item
     * @param int              $quantity
     *
     * @return $this
     */
    public function addItem(ProductInterface $item, $quantity = 1)
    {
        $result = parent::addItem($item, $quantity);
        $this->eventManager->trigger(__FUNCTION__, $this, []);
        return $result;
    }

    /**
     * @param ProductInterface $item
     * @param int              $quantity
     *
     * @return $this
     */
    public function removeItem(ProductInterface $item, $quantity = 1)
    {
        $result = parent::removeItem($item, $quantity);
        $this->eventManager->trigger(__FUNCTION__, $this, []);
        return $result;
    }

    /**
     * @return $this
     */
    public function clearItems()
    {
        $result = parent::clearItems();
        $this->eventManager->trigger(__FUNCTION__, $this, []);
        return $result;
    }

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    public function addDiscount(DiscountInterface $discount)
    {
        $result = parent::addDiscount($discount);
        $this->eventManager->trigger(__FUNCTION__, $this, []);
        return $result;
    }

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    public function removeDiscount(DiscountInterface $discount)
    {
        $result = parent::removeDiscount($discount);
        $this->eventManager->trigger(__FUNCTION__, $this, []);
        return $result;
    }

    /**
     * @return $this
     */
    public function clearDiscounts()
    {
        $result = parent::clearDiscounts();
        $this->eventManager->trigger(__FUNCTION__, $this, []);
        return $result;
    }
}