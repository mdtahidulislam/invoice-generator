<?php include('header.php'); ?>
<?php include('config.php'); ?>

<!---- START MAIN AREA ---->
<main>
	<!--========================== START  SECTION ==========================-->
   <?php include('user-logout.php'); ?>
	<section class="pb-3 non-printable">
		<div class="container">
			<div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-responsive" id="inv_list">
                        <thead>
                            <tr>
                                <th width="20%">Invoice ID</th>
                                <th width="35%">Bill To</th>
                                <th width="35%">Ship To</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $username = $_SESSION['username'];
                                $inquery = "SELECT * FROM tbl_info WHERE username = '$username'";
                                $inquery_run = mysqli_query($conn, $inquery);
                                $inrow = mysqli_num_rows($inquery_run);
                                if ($inrow > 0) {
                                    while($row = mysqli_fetch_assoc($inquery_run)){
                                        
                            ?>
                            <tr>
                                <td><?php echo $row['invnumber']; ?></td>
                                <td><?php echo $row['billto']; ?></td>
                                <td><?php echo $row['shipto']; ?></td>
                                <td>
                                    <a href="#print<?php echo urldecode($row['invnumber']); ?>" title="print" data-toggle="modal"><i class="fas fa-print"></i></a>
                                    <?php include('print_modal.php'); ?>
                                </td>
                            </tr>
                            <?php            
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center">
                    <a href="invoice.php">Create New Invoice</a>
                </div>
            </div>
		</div>
	</section>
    <div class="printable"></div>
    
	<!--========================== END  SECTION ============================-->
</main>
<!------------------------->
<!----- END MAIN AREA ----->


<?php include('footer.php'); ?>