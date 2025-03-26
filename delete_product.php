<?php 
	include "cfg/dbconnect.php";
	$product_id = $_POST['product_id'];
	$sql = "delete from product where product_id='$product_id'";
	$result = mysqli_query($conn,$sql);
	if ($result)
			$succ_msg = "Product Deleted";
		else
			$err_msg = "Error: Could not delete Product";
	?>
	<table class="table table-bordered table-striped">
	 	<tr>
	 		<thead>
	 		<th>Serial No.</th><th>Product Id</th><th>Product Name</th><th>Price (<span class="fa fa-inr">)</th><th>Stock</th><th>Action</th>
	 		</thead>
	 	</tr>
	 	<?php 
	 	$select = "select * from product order by product_id";
	 	$products = mysqli_query($conn,$select); 
	 	$counter = 0;
	 	if (mysqli_num_rows($products) >0)
	 	 {
	 		foreach ($products as $product_row) { 
	 		$counter++;
	 		$product_id = $product_row['product_id'];
			$product_name= $product_row['product_name'];?>
	 		<tr>
	 			<td><?php echo $counter;?></td>
	 			<td><?php echo $product_row['product_id'];?></td>
	 			<td><?php echo $product_row['product_name'];?></td>
	 			<td><?php echo $product_row['price'];?></td>
	 			<td><?php echo $product_row['stock'];?></td>
	 			<td>
	 				<a class="fa fa-edit" title="Edit" href="index.php?id=<?php echo $product_id;?>&flag=edit"></a> &nbsp;&nbsp;
			 		<a class="fa fa-remove" title="Delete" href="javascript:void(0)" onClick="delProduct('<?php echo $product_id;?>','<?php echo $product_name;?>')"></a>
	 			</td>
	 		</tr>
	 	<?php } 
	 	}
	 	else { ?>
	 		<tr><td colspan="7">No Products found</td></tr>
	 		<?php } ?>
	</table>
<script>
<?php if (!empty($succ_msg)) {?>
			$('#showMsg').html("<div class='alert alert-success alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><?= $succ_msg;?></div>");
			clearValues();
			<?php }
		  if (!empty($err_msg)) {?>
			$('#showMsg').html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert'>&times;</button><?= $err_msg;?></span");
		<?php } ?>

</script>
