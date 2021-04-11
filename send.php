<?php include('header.php'); ?>
<?php include('config.php'); ?>
<?php
if (isset($_POST['submit'])) {
    require 'phpmailer/PHPMailerAutoload.php';
    require 'phpmailer/class.phpmailer.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'classroomzpc@gmail.com';                 // SMTP username
$mail->Password = 'MeghBristiAlo#01';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('classroomzpc@gmail.com', 'zeropointcomputing');
$mail->addAddress($_POST['receiver']);               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

$file_name = $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], $file_name);
$mail->addAttachment($file_name);         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $_POST['subject'];
$mail->Body    = $_POST['message'];
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo '
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-sm-3">
                    <span>Message could not be sent.</span>
                </div>
            </div>
        </div>';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo '
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-sm-3">
                    <span>Message has been sent</span>
                </div>
            </div>
        </div>';
}
}
?>
<!---- START MAIN AREA ---->
<main>
	<!--========================== START  SECTION ==========================-->
  <?php include('user-logout.php'); ?>
	<section class="pb-3">
		<div class="container">
            <div class="row">
                <div class="col-md-6 offset-sm-3">
                    <button type="button" data-toggle="modal" data-target="#sendmail" name="sendmail" class="btn btn-primary btn-lg w-100 mb-4">Send Invoice on Mail</button>
                    <a href="https://www.messenger.com/" name="sendmassenger" class="btn btn-primary btn-lg w-100 mb-4">Send Invoice on Messenger</a>
                    <a href="https://www.whatsapp.com/" name="sendwhatsapp" class="btn btn-primary btn-lg w-100 mb-4">Send Invoice on Whatsapp</a>
                    <a href="download.php" class="btn btn-link btn-block btn-lg w-100 mb-4 inv-down">Download Invoice</a>
                    <hr class="mb-4">
                    <div class="my-invoic-btn text-center">
                        <a href="#">My Invoices <span class="my-inv-num">
                          <?php
                              $username = $_SESSION['username'];
                              $inquery = "SELECT * FROM tbl_info WHERE username = '$username'";
                              $inquery_run = mysqli_query($conn, $inquery);
                              $inrow = mysqli_num_rows($inquery_run);
                              echo $inrow;
                           ?>
                        </span></a>
                    </div>
                    <hr class="mb-4">
                    <div class="my-invoic-btn text-center">
                        <a href="invoice.php">Create New Invoice</a>
                    </div>
                </div>
            </div>
		</div>
	</section>
<div class="modal fade" id="sendmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label class="col-form-label">Send To:</label>
            <input name="receiver" type="email" class="form-control" id="emailto" placeholder="Enter receiver email">
          </div>
          <div class="form-group">
            <label class="col-form-label">Subject:</label>
            <input name="subject" type="text" class="form-control" id="subject" placeholder="Enter email subject">
          </div>
          <div class="form-group">
            <label class="col-form-label">Message:</label>
            <textarea name="message" class="form-control" placeholder="Enter message"></textarea>
          </div><div class="form-group">
            <label class="col-form-label">Attach Invoice:</label>
            <input name="file" type="file" class="form-control" id="file">
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="submit" class="btn btn-primary">Send Mail</button>
            </div>
        </form>
      </div>

    </div>
  </div>
	<!--========================== END  SECTION ============================-->
</main>
<!------------------------->
<!----- END MAIN AREA ----->

<?php include('footer.php'); ?>