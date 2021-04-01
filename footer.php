	<!--========================== START FOOTER SECTION ==========================-->
	<footer>
		<div class="container">
			<div class="row">

			</div>
		</div>
	</footer>
	<!--========================== END FOOTER SECTION ============================-->
	<!------------ JS HERE ------------>
	
	
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="assets/js/jquery.invoice.js"></script>
	<script>
        jQuery(document).ready(function(){
            jQuery().invoice({
                addRow : "#addRow",
                delete : ".delete",
                parentClass : ".item-row",

                price : ".price",
                qty : ".qty",
                total : ".total",
                totalQty: "#totalQty",

                subtotal : "#subtotal",
				        tax : "#tax",
                discount: "#discount",
                shipping : "#shipping",
                grandTotal : "#grandTotal",
                duebalance : "#duebalance"
            });
        });
    </script>
	<script src="assets/js/main.js"></script>
	<script>
		$( function() {
			$('#date-datepicker').datepicker();
			$('#due-datepicker').datepicker();
		});
	</script>
	<script type="text/javascript">
  $(document).ready(function(){
    var i = 0;
    $("#add").click(function(){
      i++;
      $('#dynamic_field').prepend('<tr class="item-row" id="row'+i+'"><td width="350"><input class="form-control item" placeholder="Item" type="text"></td><td><input class="form-control qty" placeholder="Quantity" type="text"></td><td><input class="form-control price" placeholder="Rate" type="text"></td><td class="text-right">$<span class="total">0.00</span></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });
    $(document).on('click', '.btn_remove', function(){  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();  
    });
  });
</script>

</body>

</html>