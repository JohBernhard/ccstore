<?php

require_once("./model/ProductDAO.php");
class ProductDAOTest extends PHPUnit_Framework_TestCase
{

  public function testGetProducts() {
    $pdao = new ProductDAO();
    $products = $pdao->getProducts();
	$this->assertNotInternalType('boolean', $products);
	$this->assertCount(count($products), $products);
    foreach ($products as $product) {
    $this->assertInternalType('int', $product->id());
	$this->assertInternalType('string', $product->title()); 
	$this->assertInternalType('string', $product->ref());
	$this->assertInternalType('float', $product->price());
	$this->assertInternalType('float', $product->tva());
	$this->assertInternalType('int', $product->weight());
	$this->assertInternalType('string', $product->weight_unit());
	$this->assertInternalType('string', $product->description());
	$this->assertInternalType('string', $product->img());
    }
  }
  public function testcreateProduct(){
	  $proData = new Product(array(
		"title" => "Title test product",
		"ref" => "Ref Product Test",
		"price" => 5.00,
		"tva" => 5.5,
		"weight" => 300,
		"weight_unit" => -3,
		"description" => "Description product test",
		"img" => "img/path.test",
	  ));
	$pdao = new ProductDAO();
	
	$product = $pdao->createProduct($proData);
	$this->assertNotInternalType('boolean', $product);
	//$this->assertInternalType('int', $product->id());
	$this->assertInternalType('string', $product->title()); 
	$this->assertInternalType('string', $product->ref());
	$this->assertInternalType('float', $product->price());
	$this->assertInternalType('float', $product->tva());
	$this->assertInternalType('int', $product->weight());
	$this->assertInternalType('string', $product->weight_unit());
	$this->assertInternalType('string', $product->description());
	$this->assertInternalType('string', $product->img());
	
	$loadedproduct = $pdao->getProductById($product->id());
	$this->assertNotInternalType('boolean', $loadedproduct);
	//$this->assertEquals($product->id(), $loadedproduct->id());
	$this->assertEquals($product->title(), $loadedproduct->title());
	$this->assertEquals($product->ref(), $loadedproduct->ref());
	$this->assertEquals($product->price(), $loadedproduct->price());
	$this->assertEquals($product->tva(), $loadedproduct->tva());
	$this->assertEquals($product->weight(), $loadedproduct->weight());
	$this->assertEquals($product->weight_unit(), $loadedproduct->weight_unit());
	$this->assertEquals($product->description(), $loadedproduct->description());
	$this->assertEquals($product->img(), $loadedproduct->img());
	  
	$delpro = $pdao->deleteProduct($product);  // delete product
	$this->assertInternalType('boolean', $delpro);  // confirm deletion
	$this->assertTrue($delpro);  // confirm deletion
  }
  public function testGetProductsByCategory() {
    $pdao = new ProductDAO();
    $products = $pdao->getProductsByCategory(4);
	$this->assertNotInternalType('boolean', $products);
	$this->assertCount(count($products), $products);
    foreach ($products as $product) {
      $this->assertInternalType('string',$product->title());
    }
  }
}

