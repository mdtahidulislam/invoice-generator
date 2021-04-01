<?php include('config.php'); ?>

<?php
    // insert data
    if (isset($_POST['sendbtn'])) {
        // get all post varialbe values
        $logo=$_POST['logo'];
        $fromto=$_POST['fromto'];
        $billto=$_POST['billto'];
        $shipto=$_POST['shipto'];
        $date= date('Y-m-d', strtotime($_POST['date']));
        $payterms=$_POST['payterms'];
        $duedate= date('Y-m-d', strtotime($_POST['duedate']));
        $notes=$_POST['notes'];
        $terms=$_POST['terms'];
        $tax=$_POST['tax'];
        $discount=$_POST['discount'];
        $shipping=$_POST['shipping'];
        $paidamount=$_POST['paidamount'];

        // insert data into table
        $query = "INSERT INTO tbl_info(logo, fromto, billto, shipto, invdate, payterms, duedate, notes, terms, tax, discount, shipping, paidamount) VALUES('$logo','$fromto','$billto','$shipto','$date','$payterms','$duedate','$notes','$terms', '$tax', '$discount', '$shipping', '$paidamount')";
        $query_run = mysqli_query($conn, $query);
        header('Location: index.php');
    }
?>
