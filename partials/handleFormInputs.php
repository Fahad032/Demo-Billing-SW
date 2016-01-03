<?php

	include_once('invoice.php');
			session_start();


	if(!isset($_SESSION['customer_name'])){
			$_SESSION['products'] = array();
		
	}
	
	$product = '';
    $totalQty = 0;
	$total = 0;
	$i=1;
	
		
	// accepts the productId to add a product into the cart
	function add_product($product){
		
		$invoice = new Invoice();
		$cartProduct = $invoice->get_product_by_id($_POST['product_name']);
		$_SESSION['products'][$product] = array(
		'product_name' => $cartProduct->product_name,
		'price'=> $cartProduct->price
		);
		
		$_SESSION['products'][$product]['color_code'] = color_code_checker();
		$_SESSION['products'][$product]['total_qty'] = total_quantity($_POST['qty']);
		
	}

	function color_code_checker(){
		
		if(isset($_POST['color_code'])){
		$color_code = $_POST['color_code'];
		return array_filter($_POST['color_code']);
		}
		
	}

	function total_quantity($qtyArr){
		$totalQty = 0;
		foreach( array_filter($qtyArr) as $key => $val ){
			$totalQty = (int)$totalQty+ (int)$val;
		
		}
		
		return $totalQty;
	
	}

	
	
	if(isset($_POST['ajax']) == 1 ){
		 $product = $_POST['product_name'];	
				 
		
		if(array_key_exists($product, $_SESSION['products'])){
			// demo should not contain such code, it will be in the final version.
			
		}else{
			add_product($_POST['product_name']);
			
		}
		 
		 $_SESSION['customer_name'] = $_POST['customer_name'];

	}
	
	
	if(isset($_POST['ajax_empty']) == 1 ){
		if(isset($_SESSION['customer_name'])){
			
			unset($_SESSION['customer_name']);
			unset($_SESSION['products' ]);

		session_destroy();
		}
	}
	

?>

		<table id="products">
				<tr>
					<th>Sl. No.</th>
					<th>Product Name</th>
					<th>T.P</th>
					<th>Quantity</th>
					<th>Amount</th>
				</tr>
				<?php 
				if(isset($_SESSION['products'])):
				foreach($_SESSION['products'] as $item): ?>
				
				<tr>
					<td><?php echo sprintf('0%2d', $i) ?></td>
					<td><?php echo $item['product_name']; ?></td>
					<td><?php echo $item['price']; ?>Tk</td>
					<td><?php echo $item['total_qty']; ?></td>
					<td><?php $subtotal = $item['total_qty']*$item['price']; echo $subtotal; ?></td>
				</tr>
				<?php
					$i++; 
					$total = $total+$subtotal;
					endforeach; 
				endif;	
				?>	
				
				<tr>
					<td colspan="4" class="total">Total:</td>
					<td class="total"><?php echo $total; ?></td>
				</tr>

		</table> 
			<p>
				<span class="amount-in-word">In Word: </span>
				<button class="btn pull-right" id="generateInvoice">Generate Invoice</button>
			</p>

	