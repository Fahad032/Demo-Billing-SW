<?php
 
 /**
  * Invoice Class to handle all of the invoice operation
  */
 class Invoice{
     
	 public $products;
	 protected $_productCode;
	 
	 
     function __construct() {
     	
		$this->products = array();		
        $this->set_products(); 
		
     }
	 
	 public function set_products(){
		$this->products[1] = array(
								'product_name' => 'Mineral Foundation',
								'price' =>  100,
								'code' => array(1, 2, 3, 4, 5)
												
								);
		
							
		
		$this->products[2] = array(
								'product_name' => 'Mousse Foundation',
								'price' =>  100,				
								'code' =>	array(21, 22, 23, 24, 25)	
							);
							
	 	
	 }
	 
	 function get_products(){
	 		return  (object)$this->products;	
	 
	 }
	 
	 
	 function get_product_by_id($id){
	 	return (object)($this->products[$id]);
	 }
	 
	 
	 
	 public function _product_Code($productKey){
	 	$product =  $this->products[$productKey];
	 	return $product['code'];
	 }
	 
	 
 }
 
 //initialization of the class
 $invoice = new Invoice();
