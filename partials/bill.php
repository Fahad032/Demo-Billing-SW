<?php

	include_once('invoice.php');
			session_start();
			$total = 0;
			$i = 0;

?>
		<p>
			Customer Name: <?php echo isset($_SESSION['customer_name'])?$_SESSION['customer_name']: ''; ?>
			<span class="pull-right">Date:</span>
		</p>
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
				<button class="btn pull-right" id="printBill">Print</button>
			</p>

	