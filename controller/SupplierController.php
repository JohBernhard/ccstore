<?php

require_once './vendor/autoload.php';
require_once './controller/AbstractController.php';
require_once './model/SupplierDAO.php';
class SupplierController extends AbstractController {
  /**
   * @Route("/")
   * @Method("GET")
   */
  function indexAction() {
   	$sdao = new SupplierDAO();
	$suppliers = $sdao->getSuppliers();
    return parent::render('suppliers.html', array(
		"suppliers" => $suppliers
	));
  }
}
