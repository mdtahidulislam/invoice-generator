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
	<script src="assets/js/main.js"></script>
	<script>
		$( function() {
			$('#date-datepicker').datepicker();
			$('#due-datepicker').datepicker();
		});
	</script>
	<script type="text/javascript">
  $(document).ready(function(){

    var i = 1;

    $("#add").click(function(){
      i++;
      $('#dynamic_field').append('<tr id="row'+i+'"><td width="500"><input type="text" name="item_name[]" placeholder="Description of service or product..." class="form-control" required/></td><td width="150"><input type="number" name="item_qty[]" class="form-control" required autocomplete="off" placeholder="Quantity"></td><td width="200"><input type="number" name="item_rate[]" placeholder="Rate" class="form-control" required></td><td width="150" align="right"><span class="amount">$0.00</span></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
    });

    $(document).on('click', '.btn_remove', function(){  
      var button_id = $(this).attr("id");   
      $('#row'+button_id+'').remove();  
    });
  });
</script>
</body>

</html>