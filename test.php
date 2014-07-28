<?php
require_once './bootstrap.php';
require_once './src/app/model/entities/Product.php';

$newProductName = 'Product';

$product = new Product();
$product->setName($newProductName);

$entityManager->persist($product);
$entityManager->flush();

echo $product->getId();