<?php
/**
 * Created by PhpStorm.
 * User: claudiopinto
 * Date: 06/09/2016
 * Time: 16:17
 */

namespace Zf2Basket\Test;


use Zf2Basket\Administration\AdministrationInterface;
use Zf2Basket\Administration\UnitedKingdom\UnitedKingdom;
use Zf2Basket\Discount\Percentage;
use Zf2Basket\Product\ProductItem;
use Zf2Basket\Storage\Adapter\Cookie;
use Zf2Basket\Storage\Container;
use Zf2Basket\Storage\StorageAdapterInterface;
use Zf2Basket\Tax\TaxInterface;

class Basket extends \PHPUnit_Framework_TestCase
{
    function testAdapterSetterAndGetter()
    {
        $basket = $this->getInstance();

        $adapter = $basket->getAdapter();
        $this->assertInstanceOf(StorageAdapterInterface::class, $adapter);

        $result = $basket->setAdapter($adapter);
        $this->assertInstanceOf(\Zf2Basket\Basket::class, $result);

    }

    function testContainerSetterAndGetter()
    {
        $basket = $this->getInstance();

        $container = $basket->getContainer();
        $this->assertInstanceOf(Container::class, $container);

        $result = $basket->setContainer($container);
        $this->assertInstanceOf(\Zf2Basket\Basket::class, $result);
    }

    function testAddRemoveClearItem()
    {
        $basket = $this->getInstance();
        $product1 = $this->getProductMock(1, 10);
        $product2 = $this->getProductMock(2, 10);

        $basket->addItem($product1, 2);
        $basket->addItem($product2, 1);
        $this->assertEquals(2, $basket->getContainer()->count($product1));

        $basket->removeItem($product1);
        $this->assertEquals(1, $basket->getContainer()->count($product1));

        $basket->clearItem($product1);
        $this->assertEquals(0, $basket->getContainer()->count($product1));

        $basket->clearItems();
        $this->assertEquals(0, $basket->getContainer()->count($product1));
        $this->assertEquals(0, $basket->getContainer()->count($product2));
    }

    function testAddRemoveClearDiscounts()
    {
        $basket = $this->getInstance();

        $discount = $this->getDiscountMock(10);

        $result = $basket->addDiscount($discount);
        $this->assertInstanceOf(\Zf2Basket\Basket::class, $result);
        $this->assertCount(1, $basket->getContainer()->getDiscounts());

        $basket->removeDiscount($discount);
        $this->assertCount(0, $basket->getContainer()->getDiscounts());

        $basket->addDiscount($discount);
        $basket->clearDiscounts();
        $this->assertCount(0, $basket->getContainer()->getDiscounts());
    }

    function testAdministrationSetterAndGetter()
    {
        $basket = $this->getInstance();
        $administration = $this->getMockAdministration();
        $result = $basket->setAdministration($administration);
        $this->assertInstanceOf(\Zf2Basket\Basket::class, $result);
        $this->assertInstanceOf(AdministrationInterface::class, $basket->getAdministration());
    }

    function testGetTotal()
    {
        $basket = $this->getInstance();
        $product = $this->getProductMock(1, 10);

        $basket->addItem($product, 2);
        $this->assertEquals(20, $basket->getTotal());
    }

    function testGetTotalDiscount()
    {
        $basket = $this->getInstance();
        $product = $this->getProductMock(1, 10);
        $discount = $this->getDiscountMock(10);
        $product->expects($this->any())
            ->method('getPrice')
            ->will($this->returnValue(10));

        $basket->addItem($product, 1)
            ->addDiscount($discount);

        $this->assertEquals(1, $basket->getTotalDiscount());
    }

    function testGetTotalDiscounted()
    {
        $basket = $this->getInstance();
        $product = $this->getProductMock(1, 10);
        $discount = $this->getDiscountMock(10);
        $product->expects($this->any())
            ->method('getPrice')
            ->will($this->returnValue(10));

        $basket->addItem($product, 1)
            ->addDiscount($discount);

        $this->assertEquals(9, $basket->getTotalDiscounted());
    }

    function testGetTotalTax()
    {
        $basket = $this->getInstance();
        $administration = $this->getMockAdministration();
        $product = $this->getProductMock(1, 10);

        $product->expects($this->any())
            ->method('isTaxable')
            ->will($this->returnValue(true));

        $basket->setAdministration($administration)
            ->addItem($product);

        /** @var TaxInterface $tax */
        $tax = $administration->getTax();
        $finalTax = round($product->getPrice() * $tax->getRate() / 100, 2);
        $result = $basket->getTotalTax();
        $this->assertEquals($finalTax, $result);
    }

    protected function getInstance()
    {
        $containerMockUp = $this->getMockBuilder(Container::class)
            ->setMethods(null)
            ->getMock();

        $adapterMock = $this->getMockBuilder(Cookie::class)
            ->setConstructorArgs([
                'name',
                [
                    StorageAdapterInterface::CONFIG_NAME => 'basket'
                ]
            ])
            ->getMock();

        $adapterMock->expects($this->any())
            ->method('pull')
            ->will($this->returnValue($containerMockUp));


        return new \Zf2Basket\Basket($adapterMock, $containerMockUp);

    }

    protected function getProductMock($id, $price)
    {

        $product = $this->getMockBuilder(ProductItem::class)
            ->setMethods(['isTaxable'])
            ->getMock();

        $product->id = $id;
        $product->price = $price;

        return $product;
    }

    protected function getDiscountMock($discount)
    {
        $mock = $this->getMockBuilder(Percentage::class)
            ->setConstructorArgs([$discount])
            ->setMethods(null)
            ->getMock();

        $mock->expects($this->any())
            ->method('getId')
            ->will($this->returnValue($discount . '%'));

        return $mock;
    }

    protected function getMockAdministration()
    {
        $mock = $this->getMockBuilder(UnitedKingdom::class)
            ->setMethods(null)
            ->getMock();

        return $mock;
    }

}