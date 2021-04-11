<?php include('config.php'); ?>
<?php session_start(); ?>

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

        // get invoice number
        $sql = "SELECT iid FROM tbl_info ORDER BY iid DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $lastid = $row['iid'];
        date_default_timezone_set('Asia/Dhaka');
        $date = date('dmy');
        if (empty($lastid)) {
            $invnum = $date.'1';
        } else {
            ++$lastid;
            $invnum = $date.$lastid;
        }

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        }
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
        $query = "INSERT INTO tbl_info(logo, invnumber, username, fromto, billto, shipto, invdate, payterms, duedate, notes, terms, tax, discount, shipping, paidamount) VALUES('$img_upload','$invnum','$username','$fromto','$billto','$shipto','$date','$payterms','$duedate','$notes','$terms', '$tax', '$discount', '$shipping', '$paidamount')";
        $query_run = mysqli_query($conn, $query);

        // insert data into tbl_item
        $items = count($_POST['item']);
        if ($items > 0) {
            for ($i=0; $i < $items; $i++) { 
                $item = $_POST['item'][$i];
                $qty = $_POST['qty'][$i];
                $rate = $_POST['rate'][$i];
                $iquery = "INSERT INTO tbl_item(item, invnumber, quantity, rate) VALUES('$item', '$invnum', '$qty', '$rate')";
                $iquery_run = mysqli_query($conn, $iquery);
            }
        }
        
        header('Location: send.php');
    }
?>
