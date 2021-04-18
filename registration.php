<?php
    include('header.php');
    include('config.php');

    
    
    
?>
<main>
	<!--========================== START  SECTION ==========================-->
	<section class="pb-3">
		<div class="container">
            <div class="row d-flex justify-content-center registration-area">
                <div class="col-lg-4 col-md-5 col-sm-4">
                    <?php
                        // registration
                        if (isset($_POST['register'])) {
                            
                            // company name
                            $company = stripslashes($_POST['company']);
                            $company = mysqli_real_escape_string($conn,$company);

                            // mobile
                            $mobile = stripslashes($_POST['mobile']);
                            $mobile = mysqli_real_escape_string($conn,$mobile);

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
                                $query = "INSERT INTO tbl_user(company,mobile,username,email,password,signature) VALUES('$company','$mobile','$user','$email','$password','$img_name')";
                                $sql = mysqli_query($conn, $query);
                                header('Location: index.php');
                            }
                        }
                    ?>
                    <form action="" method="post" enctype="multipart/form-data" class="registration-from">
                        <div class="mt-5">
                            <label>Company Name:</label>
                            <input type="text" name="company" class="form-control" placeholder="Enter company name" required>
                        </div>
                        <div>
                            <label>Mobile:</label>
                            <input type="tel" name="mobile" class="form-control" placeholder="Enter mobile no." required>
                        </div>
                        <div>
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                        </div>
                        <div>
                            <label>User Name:</label>
                            <input type="text" name="user" class="form-control" placeholder="Enter username" required>
                        </div>
                        <div>
                            <label>Password:</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                        </div>
                        <div class="form-group">
                            <label>Signature:</label>
                            <input type="file" name="signature" class="form-control" required>
                        </div>
                        <div>
                            <input type="submit" name="register" value="Register" class=" btn btn-success"> 
                            <p>Already Registered? <a href="index.php">Login here</a></p>
                        </div>
                    </form>
                </div>
            </div>
		</div>
	</section>
	<!--========================== END  SECTION ============================-->
</main>
<?php include('footer.php'); ?>
