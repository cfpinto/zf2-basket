ZF2 Basket
==========

ZF2 Basket is a Module build for Zend Framework 2. Ultimately it cam be used as a stand alone library if you don't need the ZF2 module features
 
How to install
==============
### Using composer and packagist:
```Composer install cfpinto/zf2-basket```

### Activate the module:

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

How to use
==========

Basket
------
Zf2Basket\Zf2Basket\AbstractBasket 

### Inside your controller as a service (Zf2Basket)
```php
public funcion indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket\Zf2Basket::class);
}
```

### Anywhere standalone
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
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->clearItems();
    return $this->view;
}

```

### Add a discount
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```

### 
```php
public function indexAction()
{
    $basket = $this->getServiceLocator()->get(Zf2Basket::class);
    $basket->clearItems();
    $basket->clearDiscounts();
    $basket->setAdministration(new UnitedKingdom());
    $productItem = new ProductItem();
    $productItem->id = 1;
    $productItem->price = 10;
    $productItem->name = 'Product Name';
    $quantity = 2;
    $basket->addItem($productItem, $quantity);
    $basket->addDiscount(new Percentage(20));
    $basket->removeDiscount(new Percentage(20));
    $quantity = 1;
    $basket->removeItem($productItem, $quantity);
    $basket->clearItem($productItem);
    $basket->getTotal();
    $basket->getTotalDiscounted();
    $basket->getTotalDiscount();
    return $this->view;
}

```
