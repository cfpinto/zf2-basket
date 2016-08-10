ZF2 Basket
==========

ZF2 Basket is a Module build for Zend Framework 2. Ultimately it cam be used as a stand alone library if you don't need the ZF2 module features
 
How to install
==============
### Using composer and packagist:
```composer require cfpinto/zf2-basket```

How to use
==========

Basket
------
Zf2Basket\Zf2Basket\AbstractBasket 

### Inside your controller as a service (Zf2Basket\Zf2Basket)

application.config.php
```php
<?php
return array(
    'modules' => array(
        'Application',
        'Zf2Basket',
    )
);
?>
```

```php
public funcion indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket\Zf2Basket::class);
}
```

### Anywhere as standalone (Zf2Basket\Basket)
```php

use Zf2Basket\Basket as Zf2Basket;
use Zf2Basket\Storage\Adapter\Cookie as StorageAdapterCookie;
use Zf2Basket\Storage\StorageAdapterInterface;

$basket = new Zf2Basket(new StorageAdapterCookie(session_id(), array(StorageAdapterInterface::CONFIG_NAME => 'SOME_COOKIE_NAME')));
```

Products
--------
You create product classes by implementing interface Zf2Basket\Product\ProductInterface or extending the abstract class Zf2Basket\Product\AbstractProduct

### Create a product and add to basket
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 1;

    $basket->addItem($productItem, $quantity);
}
```


### Remove a product from the basket
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;

    $basket->addItem($productItem, $quantity);
    
    $quantity = 1;
    
    $basket->removeItem($productItem, $quantity);
    return $this->view;
}
```

### Clear a product from the basket
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->clearItem($productItem);
    return $this->view;
}
```

### Clear basket items
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->clearItems();
    return $this->view;
}

```

Discounts
---------
Custom discounts can be added by implementing \Zf2Basket\Discount\DiscountInterface or by extending \Zf2Basket\Discount\AbstractDiscount
Discounts use decorator pattern to act as validators, decorators must implement \Zf2Basket\Discount\Decorator\DecoratorInterface

### Add a discount
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new \Zf2Basket\Discount\Percentage(20));
    return $this->view;
}

```

### Remove discount
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new \Zf2Basket\Discount\Percentage(20));
    $basket->removeDiscount(new \Zf2Basket\Discount\Percentage(20));
    return $this->view;
}

```

### Clear discounts 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new \Zf2Basket\Discount\Percentage(20));
    $basket->clearDiscounts();
    return $this->view;
}

```

Administration
--------------
Administration are a way to handle currency, location and taxes (will include shipping in the future)
 - Administrations implement \Zf2Basket\Administration\AdministrationInterface
 - Taxes either implement \Zf2Basket\Tax\TaxInterface or extend \Zf2Basket\Tax\AbstractTax
 - Currencies either implement \Zf2Basket\Currency\CurrencyInterface or extend \Zf2Basket\Currency\AbstractCurrency

### Setting the administration
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $basket->setAdministration(new \Zf2Basket\Administration\UnitedKingdom\UnitedKingdom());
    return $this->view;
}

```

Basket
------
### Get total basket value
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new \Zf2Basket\Administration\UnitedKingdom\UnitedKingdom());
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new \Zf2Basket\Discount\Percentage(20));
    $thia->view->basketTotalValue = $basket->getTotal();
    return $this->view;
}

```

### Get total discounted basket value
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new \Zf2Basket\Administration\UnitedKingdom\UnitedKingdom());
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new \Zf2Basket\Discount\Percentage(20));
    $this->view->basketTotalDiscountedValue = $basket->getTotalDiscounted();
    return $this->view;
}

```

### Get basket total discount value 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $basket->setAdministration(new \Zf2Basket\Administration\UnitedKingdom\UnitedKingdom());
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new \Zf2Basket\Discount\Percentage(20));
    $this->view->basketDiscountValue = $basket->getTotalDiscount();
    return $this->view;
}

```

### Get basket tax value
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(\Zf2Basket\Zf2Basket::class);
    $basket->setAdministration(new \Zf2Basket\Administration\UnitedKingdom\UnitedKingdom());
    $productItem = new \Zf2Basket\Product\ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $this->view->basketTaxValue = $basket->getTotalTax();
    return $this->view;
}

```
