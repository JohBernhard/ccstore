<?php
require_once("./model/AbstractRestClient.php");
require_once("./model/class/Supplier.class.php");
include_once './vendor/autoload.php';
use \nategood\httpful;
use \Httpful\Request;
class SupplierDAO extends AbstractRestClient {
	public function getSuppliers(){
	$result = array();
    $req = $this->req();
    $req->method("GET");
    $req->uri("$this->api_url/thirdparty/list/others?api_key=$this->api_key");
    $resp = $req->send();
	if ($resp->code == 404) {
			return false;
	}
    //echo json_encode($resp->body,JSON_PRETTY_PRINT);
	foreach ($resp->body as $data) {
      array_push($result, $this->_mapSupplier($data));
    }
    return $result;
  }
	
	public function getSupplierById($id){
		/*DO SOMETHING*/
	}
	
	public function createSupplier(Supplier $supplier){
		/*DO SOMETHING*/
	}
	public function updateSupplier(Supllier $supplier){
		/*DO SOMETHING*/
	}
	public function deleteSupplier(Supplier $supplier){
		/*DO SOMETHING*/
	}
	private function _mapSupplier($data) {
		$supplier = new Supplier(array(
		  "id" => (int)$data->id,
		  "name" => $data->name,
		  "name_alias" => $data->name_alias,
		  "address" => $data->address,
		  "zip" => $data->zip,
		  "town" => $data->town,
		));
		return $supplier;
  }
}