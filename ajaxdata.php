<?php include('config.php'); ?>

<?php
    // insert data
    if (isset($_POST['sendbtn'])) {
        // get all post varialbe values

        // for img file
        $perrmitted = array('jpg', 'jpeg', 'png', 'gif'); // permitted type
        $img_name = $_FILES['logo']['name']; // img name
        $img_size = $_FILES['logo']['size']; // img size
        $img_temp = $_FILES['logo']['tmp_name']; // img temprary file
        $img_seg = explode('.', $img_name); // img name segment
        $img_ext = strtolower(end($img_seg)); // get img extension to lower case
        $img_unique = substr(md5(time()), 0 , 10).'.'.$img_ext; // create unique name
        $img_upload = 'assets/images/uploads/'.$img_unique; // img uploaded folder
        move_uploaded_file($img_temp, $img_upload);

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

        // insert data into tbl_info
        $query = "INSERT INTO tbl_info(logo, fromto, billto, shipto, invdate, payterms, duedate, notes, terms, tax, discount, shipping, paidamount) VALUES('$img_upload','$fromto','$billto','$shipto','$date','$payterms','$duedate','$notes','$terms', '$tax', '$discount', '$shipping', '$paidamount')";
        $query_run = mysqli_query($conn, $query);

        // insert data into tbl_item
        // $items = count($_POST['item']);
        // if ($items > 0) {
        //     for ($i=0; $i < $items; $i++) { 
        //         $item = $_POST['item'][$i];
        //         $qty = $_POST['qty'][$i];
        //         $rate = $_POST['rate'][$i];
        //         $iquery = "INSERT INTO tbl_item(item, quantity, rate) VALUES('$item', '$qty', '$rate')";
        //         $iquery_run = mysqli_query($conn, $iquery);
        //     }
        // }
        header('Location: index.php');
    }
?>
