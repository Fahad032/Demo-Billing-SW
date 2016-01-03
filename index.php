<?php
	include_once('partials/invoice.php');
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<title>Invoice</title>
	<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen" title="no title" charset="utf-8"/>
	
	<script src="js/jquery.js"></script>
	<script src="js/custom.js"></script>
	
</head>
<body>
	<div class="container">
		<section id="invoice">

				<h2 class="text-center">Input Form</h2>
				<hr />
				<form id="invoice_form" action="index_submit" method="get" accept-charset="utf-8">
					<div class="left-side">
						<p>
							<label for="customer_name">Customer Name: </label>
							<input type="text" name="customer_name" id="customer_name" />
						</p>
						<p>
							<label for="invoice">Invoice: </label>
							<input type="text" name="invoice" id="invoice" />
						</p>
						<p>
							<label for="product_name">Product Name: </label>
							<select name="product_name" id="product_name">
								<?php 
									foreach($invoice->get_products() as $product_key => $product_val):
								?>	
									<option value="<?php echo $product_key ?>"> <?php echo $product_val['product_name'] ?> </option>
	
								<?php		
									endforeach;
								?>
							</select>
						</p>
						
						<div class="clearfix"></div>
						<div id="checkboxWrapper">
							<div class="clearfix"></div>
							
							<?php
							foreach( range(1, 2) as $productID){
							?>
								<div class="color-code color-code-<?php echo $productID; ?>">
							<?php 									
								foreach($invoice->_product_Code($productID) as $code):
							?>
							<label ><input type="checkbox" name="color_code[]" value="<?php echo $code ?>"  /><?php echo $code ?><input type="text" name="qty[<?php echo $code ?>]" class="qty" /></label>
								  
							
							<?php
								endforeach;
								echo "</div>";
							}
							 ?>							
						</div>

					</div>
					<div class="right-side">
						<p>
							<label for="package">Package: </label>
							<input type="text" name="package" id="package" />
						</p>
						<p>
							<label for="date">Date: </label>
							<input type="text" name="date" id="date" />
						</p>
						<p>
							<input type="hidden" name="ajax" value="1" />
						</p>
						<p>
							<input type="submit" name="add" id="add_submit" value="Add Product" />
							<button class="btn" id="empty_cart">Remove All Item</button>
						</p>

					</div>

				</form>
				
				
		</section><!-- /invoice -->
		<div class="clearfix"></div>
		
		<section id="product-list">
			<table id="products">
				<tr>
					<th>Sl. No.</th>
					<th>Product Name</th>
					<th>T.P</th>
					<th>Quantity</th>
					<th>Amount</th>
				</tr>
				<tr>
					<td colspan="4" class="total">Total:</td>
					<td class="total">0</td>
				</tr>

			</table>
			
			<p>
				<span class="amount-in-word">In Word: </span>
				<button class="btn pull-right" id="generateInvoice">Generate Invoice</button>
			</p>
		</section>



	</div>
	
	<div class="transparent"></div>
	
	<!-- Added a new comment to checkout the terminal commit action -->
	<span class="fa fa-facebook"></span>
	
</body>
</html>