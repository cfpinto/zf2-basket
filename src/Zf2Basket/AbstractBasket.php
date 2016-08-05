<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 04/08/2016
 * Time: 16:13
 */

namespace Zf2Basket;


use Zf2Basket\Discount\DiscountInterface;
use Zf2Basket\Product\AbstractProduct;
use Zf2Basket\Storage\Container;
use Zf2Basket\Storage\StorageAdapterInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;

abstract class AbstractBasket implements EventManagerAwareInterface, ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;
    /**
     * @var StorageAdapterInterface
     */
    private $adapter;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var EventManagerInterface
     */
    private $eventManager;

    /**
     * AbstractBasket constructor.
     *
     * @param StorageAdapterInterface $adapter
     * @param Container               $container
     */
    function __construct(StorageAdapterInterface $adapter, Container $container)
    {
        return $this->setAdapter($adapter)
            ->setContainer($container)
            ->init();
    }

    /**
     * @return StorageAdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param StorageAdapterInterface $adapter
     *
     * @return $this
     */
    public function setAdapter(StorageAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        return $this;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Container $container
     *
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
        return $this;
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
        $this->eventManager = $eventManager;
        return $this;
    }

    /**
     *
     */
    public function init()
    {
        $this->read();
    }

    /**
     *
     */
    final protected function write()
    {
        $this->adapter->put($this->container);
    }

    /**
     *
     */
    final protected function read()
    {
        $this->container->setItems($this->adapter->pull()->getItems());
    }

    /**
     *
     */
    final protected function delete()
    {
        $this->container->clear();
        $this->adapter->delete();
    }

    /**
     * @param AbstractProduct $item
     * @param int             $quantity
     *
     * @return $this
     */
    abstract function addItem(AbstractProduct $item, $quantity = 1);

    /**
     * @param AbstractProduct $item
     * @param int             $quantity
     *
     * @return $this
     */
    abstract function removeItem(AbstractProduct $item, $quantity = 1);

    /**
     * @param AbstractProduct $item
     *
     * @return $this
     */
    abstract function clearItem(AbstractProduct $item);

    /**
     * @return $this
     */
    abstract function clearItems();

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    abstract function addDiscount(DiscountInterface $discount);

    /**
     * @param DiscountInterface $discount
     *
     * @return $this
     */
    abstract function removeDiscount(DiscountInterface $discount);

    /**
     * @return $this
     */
    abstract function clearDiscounts();

}