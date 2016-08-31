<?php
/**
 * Created by PhpStorm.
 * User: Claudio Pinto
 * Date: 04/08/2016
 * Time: 16:13
 */

namespace Zf2Basket;


use Zf2Basket\Administration\AdministrationInterface;
use Zf2Basket\Discount\DiscountInterface;
use Zf2Basket\Product\ProductInterface;
use Zf2Basket\Storage\Container;
use Zf2Basket\Storage\StorageAdapterInterface;

abstract class AbstractBasket
{
    /**
     * @var StorageAdapterInterface
     */
    private $adapter;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var AdministrationInterface
     */
    protected $administration;

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
     *
     */
    public function init()
    {
        $this->read();
        return $this;
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
        $this->container->setDiscounts($this->adapter->pull()->getDiscounts());
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
     * @param ProductInterface $item
     * @param int                              $quantity
     *
     * @return $this
     */
    abstract function addItem(ProductInterface $item, $quantity = 1);

    /**
     * @param ProductInterface $item
     * @param int             $quantity
     *
     * @return $this
     */
    abstract function removeItem(ProductInterface $item, $quantity = 1);

    /**
     * @param ProductInterface $item
     *
     * @return $this
     */
    abstract function clearItem(ProductInterface $item);

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

    /**
     * @param AdministrationInterface $administration
     *
     * @return $this
     */
    abstract function setAdministration(AdministrationInterface $administration);

    /**
     * @return AdministrationInterface
     */
    abstract function getAdministration();

    /**
     * @return float
     */
    abstract function getTotal();

    /**
     * @return float
     */
    abstract function getTotalTax();

    /**
     * @return float
     */
    abstract function getTotalDiscounted();

    /**
     * @return float
     */
    abstract function getTotalDiscount();

    /**
     * @return array
     */
    abstract function toArray();

}