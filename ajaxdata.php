<?php include('config.php'); ?>
<?php
    $name = $_POST['name'];
    $q = "INSERT INTO tbl(name) VALUES('$name')";
    $q_run = mysqli_query($conn, $q);
?>