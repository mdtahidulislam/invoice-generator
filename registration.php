<?php
    include('header.php');
    include('config.php');

    
    
    // registration
    if (isset($_POST['register'])) {
        

        // user
        $user = stripslashes($_POST['user']);
        $user = mysqli_real_escape_string($conn,$user);
        
        // email
        $email = stripslashes($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "
                <div class='alert alert-warning d-flex justify-content-center' role='alert'>
                    invalid email format
                </div>
            ";
        }
        $email = mysqli_real_escape_string($conn,$email);

        // password
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn,$password);

        // signature image
        $perrmitted = array('jpg', 'jpeg', 'png'); // permitted type
        $img_name = $_FILES['signature']['name']; // img name
        $img_size = $_FILES['signature']['size']; // img size
        $img_temp = $_FILES['signature']['tmp_name']; // img temprary file
        $img_seg = explode('.', $img_name); // img name segment
        $img_ext = strtolower(end($img_seg)); // get img extension to lower case
        //$img_unique = substr(md5(time()), 0 , 10).'.'.$img_ext; // create unique name
        $img_upload = 'assets/images/signature/'.$img_name; // img uploaded folder

        $namequery = "SELECT username FROM tbl_user WHERE username = '$user'";
        $namesql = mysqli_query($conn, $namequery);
        if (mysqli_num_rows($namesql) > 0 ) {
            echo "
                <div class='alert alert-warning d-flex justify-content-center' role='alert'>
                    username already exixts, try another
                </div>
            ";
        } elseif ($img_size > 1048567) {
            echo "
                <div class='alert alert-warning d-flex justify-content-center' role='alert'>
                    Image Size should be less then 1MB!
                </div>
            ";
        } elseif(in_array($img_ext, $perrmitted) === false) {
            echo "
                <div class='alert alert-warning d-flex justify-content-center' role='alert'>
                    You can upload only:-".implode(', ', $perrmitted)."
                </div>
            ";
        } else{
            move_uploaded_file($img_temp, $img_upload);
            $query = "INSERT INTO tbl_user(username,email,password,signature) VALUES('$user','$email','$password','$img_name')";
            $sql = mysqli_query($conn, $query);
            header('Location: registration.php');
        }

        
        // img validation insert data
        // if ($img_size > 1048567) {
        //     echo "<span class='error'>Image Size should be less then 1MB!</span>";
        // } elseif(in_array($img_ext, $perrmitted) === false) {
        //     echo "<span class='error'>You can upload only:-"
        //         .implode(', ', $perrmitted)."</span>";
        // } else{
            
        // }
    }




?>
<main>
	<!--========================== START  SECTION ==========================-->
	<section class="pb-3">
		<div class="container">
            <div class="row">
                <div class="col-md-6 offset-sm-3">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div>
                            <label>User Name:</label>
                            <input type="text" name="user" class="form-control">
                            
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Signature:</label>
                            <input type="file" name="signature" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" value="Register" class=" btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</section>
	<!--========================== END  SECTION ============================-->
</main>
<?php include('footer.php'); ?>
