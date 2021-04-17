<?php include('header.php'); ?>
<?php include('config.php'); ?>
<?php include('auth.php'); ?>
<?php
   // invoice number generate
   $sql = "SELECT iid FROM tbl_info ORDER BY iid DESC LIMIT 1";
   $result = mysqli_query($conn, $sql);
   $row = mysqli_fetch_assoc($result);
   $lastid = $row['iid'];
   date_default_timezone_set('Asia/Dhaka');
   $date = date('dmy');
   if (empty($lastid)) {
       $invnum = $date.'1';
   } else {
       $lastid++;
       $invnum = $date.$lastid;
   }
?>


<!---- START MAIN AREA ---->
<main>
	<!--========================== START  SECTION ==========================-->
   <?php include('user-logout.php'); ?>
	<section class="pb-3">
		<div class="container">
			<form action="create.php" class="invoice" method="POST" enctype="multipart/form-data">
            <div class="row">
               <div class="col-md-9 col-sm-12 inv-info">
                  <div class="row">
                     <div class="col">
                        <div class="inv-info__contact">
                           <div class="inv-file-input form-group">
                              <input type="file" id="fileinput" name="logo" class="inv-file-input">
                              <label class="inv-file-label" for="customFile">+ Add Your Logo</label>
                           </div>
                           <div class="preview d-none" id="preview">
                              <img class="preview-img" src="">
                              <i class="fas fa-times close-img"></i>
                           </div>
                           <div class="form-group">
                              <textarea name="fromto" id="fromto" rows="2" class="form-control" placeholder="Who is this invoice from? (required)"></textarea>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <label> Bill To</label>
                                    <textarea type="text" name="billto" id="billto" class="form-control" placeholder="Who is this invoice to? (required)"></textarea>
                                 </div>
                                 <div class="col-sm-6">
                                    <label> Ship To</label>
                                    <textarea type="text" name="shipto" id="shipto" class="form-control" placeholder="(Optional)"></textarea>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col">
                        <div class="inv-title">
                           <h1 class="mb-3 text-right">INVOICE</h1>
                           <div class="inv-number">
                              <div class="input-group mb-3">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">#</span>
                                 </div>
                                 <input type="text" dir="rtl" name="inv_num" class="form-control inv-num-input" value="<?php echo $invnum; ?>" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="inv-details d-flex justify-content-end">
                           <table>
                              <tr>
                                 <td><label class="mr-4">Date</label></td>
                                 <td><input type="text" name="date" id="date-datepicker" class="form-control mb-3" required autocomplete="off"></td>
                              </tr>
                              <tr>
                                 <td><label class="mr-4">Payment Terms</label></td>
                                 <td><input type="text" name="payterms" id="payterms" class="form-control mb-3" required></td>
                              </tr>
                              <tr>
                                 <td><label class="mr-4">Due Date</label></td>
                                 <td><input type="text" name="duedate" id="due-datepicker" class="form-control mb-3" required autocomplete="off"></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <!-- items holder -->
                  <div class="row">
                     <div class="col">
                        <div class="table-responsive">
                           <table class="table" id="dynamic_field">
                              <thead>
                                 <tr class="item-row">
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th>Rate</th>
                                    <th class="total-th">Total</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr class="item-row" id="row">
                                    <td width="350"><input class="form-control item" name="item[]" placeholder="Item" type="text"></td>
                                    <td width="100"><input class="form-control qty" name="qty[]" placeholder="Quantity" type="text"></td>
                                    <td width="150"><input class="form-control price" name="rate[]" placeholder="Rate" type="text"></td>
                                    <td class="text-right">$<span class="total">0.00</span></td>
                                    <td></td>
                                 </tr>
                                 <tr>
                                    <td colspan="4">
                                       <button type="button" name="add" id="add" class="btn btn-primary mb-4">+ Line Item</button>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <table>
                              <tr>
                                 <td width="50%">
                                    <table width="100%">
                                       <tr>
                                          <td>
                                             <div class="notes-holder">
                                                <div class="form-group mb-5">
                                                   <label>Notes</label>
                                                   <textarea name="notes" id="notes" rows="2" class="form-control" placeholder="Notes - any relevant information not already covered"></textarea>
                                                </div>
                                             </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <div class="terms-holder">
                                                <div class="form-group">
                                                   <label>Terms</label>
                                                   <textarea name="terms" id="terms" rows="2" class="form-control" placeholder="Terms and conditions - late fees, payment methods, delivery schedule"></textarea>
                                                </div>
                                             </div>
                                          </td>
                                       </tr>
                                    </table>
                                 </td>
                                 <td width="50%">
                                    <table class="table">
                                       <tr>
                                          <td></td>
                                          <td></td>
                                          <td class="text-right">Sub Total</td>
                                          <!-- <td class="text-right">$<span id="subtotal">0.00</span></td> -->
                                          <td class="text-right">$ <input type="text" name="subtotal" id="subtotal"> 
                                       </tr>
                                       <tr>
                                          <td></td>
                                          <td></td>
                                          <td class="text-right">Tax</td>
                                          <td>
                                             <div class="input-group tax mb-3">
                                                <input type="number" name="taxpercent" id="tax" dir="rtl" placeholder="0" autocomplete="off" class="tax-input form-control">
                                                <div class="input-group-prepend ">
                                                   <span class="input-group-text tax-type-dollar d-none">$</span>
                                                </div>
                                                <div class="input-group-append">
                                                   <span class="input-group-text tax-type-prcent">%</span>
                                                </div>
                                                <div id="tax-type" class="input-group-append">
                                                   <button class="btn dropdown-toggle tax-type-btn" type="button" id="tax-type-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   </button>
                                                   <ul class="dropdown-menu dropdown-menu-right" id="tax-type-selector" aria-labelledby="dropdownMenuButton">
                                                      <li class="dropdown-item">Flat($)</li>
                                                      <li class="dropdown-item active">Percent(%)</li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </td>
                                       </tr>
                                       <tr class="input-type-row d-none">
                                          <td></td>
                                          <td></td>
                                          <td class="text-right">Discount</td>
                                          <td>
                                             <!-- <input class="form-control" id="discount" value="0" type="text"> -->
                                             <div class="input-group discount mb-3">
                                                <input type="number" name="discountpercent" id="discount" dir="rtl" placeholder="0" autocomplete="off" class="discount-input form-control">
                                                <div class="input-group-prepend ">
                                                   <span class="input-group-text discount-type-dollar d-none">$</span>
                                                </div>
                                                <div class="input-group-append">
                                                   <span class="input-group-text discount-type-prcent">%</span>
                                                </div>
                                                <div id="discount-type" class="input-group-append">
                                                   <button class="btn dropdown-toggle tax-type-btn" type="button" id="discount-type-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   </button>
                                                   <ul class="dropdown-menu dropdown-menu-right" id="discount-type-selector" aria-labelledby="dropdownMenuButton">
                                                      <li class="dropdown-item">Flat($)</li>
                                                      <li class="dropdown-item active">Percent(%)</li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </td>
                                          <td>
                                             <button type="button" name="remove" id="" class="btn delete-btn">&times;</button>
                                          </td>
                                       </tr>
                                       <tr class="input-type-row d-none">
                                          <td></td>
                                          <td></td>
                                          <td class="text-right">Shipping</td>
                                          <td>
                                             <div class="input-group shipping mb-3">
                                                <input type="number" name="shippingpercent" id="shipping" dir="rtl" placeholder="0" autocomplete="off" class="shipping-input form-control">
                                                <div class="input-group-prepend ">
                                                   <span class="input-group-text shipping-type-dollar d-none">$</span>
                                                </div>
                                                <div class="input-group-append">
                                                   <span class="input-group-text shipping-type-prcent">%</span>
                                                </div>
                                                <div id="shipping-type" class="input-group-append">
                                                   <button class="btn dropdown-toggle tax-type-btn" type="button" id="shipping-type-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   </button>
                                                   <ul class="dropdown-menu dropdown-menu-right" id="shipping-type-selector" aria-labelledby="dropdownMenuButton">
                                                      <li class="dropdown-item">Flat($)</li>
                                                      <li class="dropdown-item active">Percent(%)</li>
                                                   </ul>
                                                </div>
                                             </div>
                                          </td>
                                          <td>
                                             <button type="button" name="remove" id="" class="btn delete-btn">&times;</button>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td></td>
                                          <td></td>
                                          <td></td>
                                          <td width="195" align="right">
                                             <button type="button" id="" class="btn btn-primary show-btn mb-4">+ Discount</button>
                                             <button type="button" id="" class="btn btn-primary show-btn mb-4">+ Shipping</button>
                                          </td>
                                          <td width="20"></td>
                                       </tr>
                                       <tr>
                                          <td></td>
                                          <td></td>
                                          <td class="text-right">Total</td>
                                          <!-- <td class="text-right">$<span id="grandTotal">0</span></td> -->
                                          <td class="text-right">$ <input type="text" name="grandtotal" id="grandTotal"> </td>
                                       </tr>
                                       <tr>
                                          <td></td>
                                          <td></td>
                                          <td class="text-right">Amount Paid</td>
                                          <td class="text-right">
                                             <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text" id="payment-input-text">$</span>
                                                </div>
                                                <input type="text" name="paidamount" id="paidamount" class="payment-input form-control" placeholder="0" >
                                             </div>
                                          </td>
                                          <td></td>
                                       </tr>
                                       <tr>
                                          <td></td>
                                          <td></td>
                                          <td class="text-right">Balance Due</td>
                                          <!-- <td class="text-right">$<span class="mb-3" id="duebalance">$0.00</span></td> -->
                                          <td class="text-right">$ <input type="text" name="duebalance" id="duebalance" readonly></td>
                                          <td></td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <!-- signature -->
                  <div class="row">
                     <div class="col-md-6">
                     <?php 
                        if (isset($_SESSION['username'])) {
                           $username =   $_SESSION['username'];
                        $sig = "SELECT signature FROM tbl_user WHERE username = '$username'";
                        $sigsql = mysqli_query($conn, $sig);
                        $sigresult = mysqli_fetch_assoc($sigsql);
                     ?>
                     <div class="signature">
                        <img src="assets/images/signature/<?php echo $sigresult['signature']; ?>" alt="signature" class="img-fluid">
                     </div>
                     <?php
                        }
                     ?> 
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-12">
                  <div class="sidebar">
                     <button type="submit" name="sendbtn" class="sendbtn btn btn-success btn-lg w-100 mb-4"> Save Invoice</button>
                     <a href="send.php" class="btn btn-success btn-block btn-lg w-100 mb-4 inv-down">Send Invoice</a>
                     <hr class="mb-4">
                     <a href="download.php" class="btn btn-success btn-block btn-lg w-100 mb-4 inv-down">Download Invoice</a>
                     <hr class="mb-4">
                     <div class="my-invoic-btn text-center">
                        <a href="download.php">My Invoices 
                        <span class="my-inv-num">
                           <?php
                              $username = $_SESSION['username'];
                              $inquery = "SELECT * FROM tbl_info WHERE username = '$username'";
                              $inquery_run = mysqli_query($conn, $inquery);
                              $inrow = mysqli_num_rows($inquery_run);
                              echo $inrow;
                           ?>
                        </span></a>
                     </div>
                  </div>
               </div>
            </div>
         </form>
		</div>
	</section>
	<!--========================== END  SECTION ============================-->
</main>
<!------------------------->
<!----- END MAIN AREA ----->


<?php include('footer.php'); ?>
