<?php include('header.php'); ?>
<?php 
    include('config.php'); 
    //session_start();
?>

<main>
    <section class="login-area">
        <div class="container">
            <div class="row login-area">
                <div class="col-md-5">
                    <?php
                        if (isset($_POST['username'])) {
                            // username
                            $username = stripslashes($_POST['username']);
                            $username = mysqli_real_escape_string($conn, $username);
                    
                            // password
                            $password = stripslashes($_POST['password']);
                            $password = mysqli_real_escape_string($conn, $password);
                    
                            // check user
                            $uquery = "SELECT * FROM tbl_user WHERE username = '$username' AND password = '$password'";
                            $uquery_run = mysqli_query($conn, $uquery);
                            $urows = mysqli_num_rows($uquery_run);
                            
                            // create user session 
                            if ($urows == 1) {
                                $_SESSION['username'] = $username;
                                header('Location: invoice.php');
                            } else {
                                echo "
                                    <p>Username/password is incorrect.</p>
                                     ";
                            }
                        }
                    ?>
                    <form action="" method="post" name="login">
                        <div class="form-group">
                            <input type="text" name="username" placeholder="Username" required class="form-control" />
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" placeholder="Password" required class="form-control"/>
                        </div>
                        <input name="submit" type="submit" value="Login" class="btn btn-primary" />
                    </form>
                    <p>Not registered yet? <a href='registration.php'>Register Here</a></p>
                </div>
            </div>
        </div>
    </section>
</main>
<?php include('footer.php'); ?>