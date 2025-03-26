 $("#frm :input").change(function() {
   		$("#frm").data("changed",true);
	});
 function addProduct()  {
	 var p_name = $('#p_name').val(); 
	 var price = $('#price').val();
	 var stock = $('#stock').val(); 
	 if (!validateData(p_name,price,stock))
	 	return false;
	
     $.ajax({  
           url:"add_product.php",  
           type:"POST",  
           data:{p_name:p_name, price:price,stock:stock}, 
           dataType:"text",  
           success:function(response) {  
           	$("#products").html(response);
           }  
      	}); 
	}
function updateProduct()  {
	 var product_id = $('#product_id').val();  
	 var p_name = $('#p_name').val(); 
	 var price = $('#price').val();
	 var stock = $('#stock').val(); 
	 
	 if (!validateData(p_name,price,stock))
	 	return false;
	 if ($("#frm").data("changed")) {
          $.ajax({  
                   url:"update_product.php",  
                   type:"POST",  
                   data:{product_id:product_id, p_name:p_name, price:price,stock:stock}, 
                   dataType:"text",  
                   success:function(response) {  
                   	$("#products").html(response);
                   }  
              }); 
      	}
      	else {
      		alert("No changes to save");
      		return false;
      	}
	}

function delProduct(product_id, product_name){
	if (confirm("Are you sure you want to delete product - "+product_name+"?")){
		$.ajax({  
                   url:"delete_product.php",  
                   type:"POST",  
                   data:{product_id:product_id}, 
                   dataType:"text",  
                   success:function(response) {  
                   	$("#products").html(response);
                   }  
              }); 
	}
} 
function validateData(p_name,p_price,p_stock){
	 if (p_name.trim() =="")  {
	  $("#product_err").text("Product Name must have a value");
	  return false;
	  }
	  if (p_price.trim() == "") p_price = 0;
 	  if(p_price <= 0)
		{
	  	$("#price_err").html("Enter a positive value for price");
	  	$("#price").focus();
	  	return false;
	  	}
	  if (p_stock.trim() == "") {
	  	$("#stock_err").html("Stock should be zero or positive");
	  	$("#stock").focus();
	  	return false;
	  }
	  if (p_stock <0) {
	  	$("#stock_err").html("Stock should be zero or positive");
	  	$("#stock").focus();
	  	return false;
	  }
	return true;
}

function clearValues(){
	//clear the form fields
   	$("#product_id").val("");
   	$("#p_name").val("");
   	$("#price").val("");
   	$("#stock").val("");
   	$("#product_err").html("");
   	$("#price_err").html("");
   	$("#stock_err").html("");
}
