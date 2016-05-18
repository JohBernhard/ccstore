<?php
require_once("./model/AbstractRestClient.php");
require_once("./model/class/Product.class.php");
include_once './vendor/autoload.php';
use \nategood\httpful;
use \Httpful\Request;
class ProductDAO extends AbstractRestClient {
  public function getProducts() {
    $result = array();
    $req = $this->req();
    $req->method("GET");
    $req->uri("$this->api_url/product/list?api_key=$this->api_key");
    $resp = $req->send();
	if ($resp->code == 404) {
			return false;
	}
    //echo json_encode($resp->body,JSON_PRETTY_PRINT);
    foreach ($resp->body as $data) {
      array_push($result, $this->_mapProduct($data));
    }
    return $result;
  }
  /**
   * @param id $id Id produit a récupérer
   */
  public function getProductById($id) {
    $req = $this->req();
    $req->method("GET");
    $req->uri("$this->api_url/product/".$id."?api_key=$this->api_key");
    $res = $req->send();
    $product = $this->_mapProduct($res->body);
    return $product;
  }
  /**
   * @param Product $produit Objet Product a completer
   */
  public function getProductCategories(Product $product) {
    $req = $this->req();
    $req->method("GET");
    $req->uri("$this->api_url/product/".$product->id_p()."/categories?api_key=$this->api_key");
    $resp = $req->send();
    $product->setCategories($resp->body);
    return $product;
  }
  public function getProductsByCategory($category) {
    $result = array();
    $req = $this->req();
    $req->method("GET");
    $req->uri("$this->api_url/product/list/category/$category?api_key=$this->api_key");
    $resp = $req->send();
	 if ($resp->code == 404) {
			return false;
	}
    foreach ($resp->body as $data) {
      array_push($result, $this->_mapProduct($data));
    }
    return $result;
  }
  public function createProduct(Product $product){
	  /*DO SOMETHING*/
	  return $product; 
  }
  public function updateProduct(Product $product){
	  /*DO SOMETHING*/
  }
public function deleteProduct(Product $product){
	/*DO SOMETHING*/
}  
  
  private function _mapProduct($data) {
    $product = new Product(array(
      "id" => (int)$data->id,
      "ref" => $data->ref,
      "title" => $data->label,
      "description" => $data->description,
      "tva" => (float)$data->tva_tx,
      "price" => (float)$data->price_ttc,
	  "weight" => $data->weight,
	  "weight_unit" => $data->weight_units
    ));
    return $product;
  }
  private function _getProductCategories(Product $product) {
    $req = $this->req();
    $req->method("GET");
    $req->uri("$this->api_url/product/"
      .$product->id_p()
      ."/categories/?api_key=$this->api_key");
    $resp = $req->send();
  }

}
