<?php include('header.php'); ?>
<?php include('config.php'); ?>
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
                                    <th>Total</th>
                                    <th></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr class="item-row" id="row">
                                    <td width="350"><input class="form-control item" name="item[]" placeholder="Item" type="text"></td>
                                    <td><input class="form-control qty" name="qty[]" placeholder="Quantity" type="text"></td>
                                    <td><input class="form-control price" name="rate[]" placeholder="Rate" type="text"></td>
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
                                          <td class="text-right">$<span id="subtotal">0.00</span></td>
                                       </tr>
                                       <tr>
                                          <td></td>
                                          <td></td>
                                          <td class="text-right">Tax</td>
                                          <td>
                                             <div class="input-group tax mb-3">
                                                <input type="number" name="tax" id="tax" dir="rtl" placeholder="0" autocomplete="off" class="tax-input form-control">
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
                                                      <li class="dropdown-item active" name="percent">Percent(%)</li>
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
                                                <input type="number" name="discount" id="discount" dir="rtl" placeholder="0" autocomplete="off" class="discount-input form-control">
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
                                                <input type="number" name="shipping" id="shipping" dir="rtl" placeholder="0" autocomplete="off" class="shipping-input form-control">
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
                                          <td class="text-right">$<span id="grandTotal">0</span></td>
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
                                          <td class="text-right">$<span class="mb-3" id="duebalance">$0.00</span></td>
                                          <td></td>
                                       </tr>
                                    </table>
                                 </td>
                              </tr>
                           </table>
                        </div>
                        <!-- <div class="table-responsive-sm">
                           <table class="table" id="dynamic_field">
                              <thead class="thead-dark">
                                 <tr class="item-row">
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col"></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr id="row0" class="item-row single-ro txtMult">
                                    <td width="500">
                                       <input type="text" name="item_name[]" id="item-name" placeholder="Description of service or product..." class="item-name form-control" required>
                                    </td>
                                    <td width="150">
                                       <input type="number" name="item_qty[]" id="item-qty" class="qty item-qty form-control" required autocomplete="off" placeholder="Quantity">
                                    </td>
                                    <td width="200">
                                       <input type="number" name="item_rate[]" id="item-rate" class="price item-rate form-control" placeholder="Rate" required>
                                    </td>
                                    <td width="150" align="right">
                                       <span class="total amount multTotal">$0.00</span>
                                    </td>
                                    <td></td>
                                 </tr>
                                 <tr id="row0" class="single-ro txtMult">
                                    <td width="500">
                                       <input type="text" name="item_name[]" id="item-name" placeholder="Description of service or product..." class="item-name form-control" required>
                                    </td>
                                    <td width="150">
                                       <input type="number" name="item_qty[]" id="item-qty" class="val1 item-qty form-control" required autocomplete="off" placeholder="Quantity">
                                    </td>
                                    <td width="200">
                                       <input type="number" name="item_rate[]" id="item-rate" class="val2 item-rate form-control" placeholder="Rate" required>
                                    </td>
                                    <td width="150" align="right">
                                       <span class="amount multTotal">$0.00</span>
                                    </td>
                                    <td></td>
                                 </tr>
                              </tbody>
                           </table>
                           <button type="button" name="add" id="add" class="btn btn-primary mb-4">+ Line Item</button>
                        </div> -->
                     </div>
                  </div>
                  <!-- <div class="row">
                     <div class="col-md-6 col-sm-12">
                        <div class="notes-holder">
                           <div class="form-group mb-5">
                              <label>Notes</label>
                              <textarea name="notes" id="" rows="2" class="form-control" placeholder="Notes - any relevant information not already covered"></textarea>
                           </div>
                        </div>
                        <div class="terms-holder">
                           <div class="form-group">
                              <label>Notes</label>
                              <textarea name="notes" id="" rows="2" class="form-control" placeholder="Terms and conditions - late fees, payment methods, delivery schedule"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6 col-sm-12">
                        <div class="rates-cal d-flex justify-content-end">
                           <table id="rates_field">
                              <tr>
                                 <td width="195" align="right"><label class="mr-4">Subtotal</label></td>
                                 <td width="195" align="right"><span class="mb-3 subtotal" id="subtotal">$0.00</span></td>
                                 <td width="20"></td>
                              </tr>
                              <tr>
                                 <td width="195" align="right"><label class="mr-4">Tax</label></td>
                                 <td width="195" align="right">
                                    <div class="input-group tax mb-3">
                                       <input type="number" name="tax" id="tax-input" dir="rtl" placeholder="0" autocomplete="off" class="tax-input form-control">
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
                                 <td width="20"></td>
                              </tr>
                              <tr id="" class="input-type-row d-none">
                                 <td width="195" align="right"><label class="m-0 mr-4">Discount</label></td>
                                 <td width="195" align="right">
                                    <div class="input-group discount mb-3">
                                       <input type="number" name="discount" id="discount" dir="rtl" placeholder="0" autocomplete="off" class="discount-input form-control">
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
                                 <td width="20"><button type="button" name="remove" id="" class="btn delete-btn">&times;</button></td>
                              </tr>
                              <tr id="" class="input-type-row d-none">
                                 <td width="195" align="right"><label class="m-0 mr-4">Shipping</label></td>
                                 <td width="195" align="right">
                                    <div class="input-group shipping mb-3">
                                       <input type="number" name="shipping" id="shipping-input" dir="rtl" placeholder="0" autocomplete="off" class="shipping-input form-control">
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
                                 <td width="20"><button type="button" name="remove" id="" class="btn delete-btn">&times;</button></td>
                              </tr>
                           </table>
                        </div>
                        <table align="right">
                           <tr>
                              <td></td>
                              <td width="195" align="right">
                                 <button type="button" id="" class="btn btn-primary show-btn mb-4">+ Discount</button>
                                 <button type="button" id="" class="btn btn-primary show-btn mb-4">+ Shipping</button>
                              </td>
                              <td width="20"></td>
                           </tr>
                        </table>
                        <table width="100%">
                           <tr>
                              <td width="195" align="right"><label class="mr-4">Total</label></td>
                              <td width="195" align="right"><span class="mb-3 total" id="grandTotal">$0.00</span></td>
                              <td width="20"></td>
                           </tr>
                           <tr>
                              <td width="195" align="right"><label class="m-0 mr-4">Amount Paid</label></td>
                              <td width="195" align="right">
                                 <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                       <span class="input-group-text" id="payment-input-text">$</span>
                                    </div>
                                    <input type="number" class="payment-input form-control" placeholder="0" >
                                 </div>
                              </td>
                              <td width="20"></td>
                           </tr>
                           <tr>
                              <td width="195" align="right"><label class="m-0 mr-4">Balance Due</label></td>
                              <td width="195" align="right"><span class="mb-3">$0.00</span></td>
                              <td width="20"></td>
                           </tr>
                        </table>
                     </div>
                  </div> -->
               </div>
               <div class="col-md-3 col-sm-12">
                  <div class="sidebar">
                     <button type="submit" name="sendbtn" class="sendbtn btn btn-primary btn-lg w-100 mb-4" onclick="print()"> Send Invoice</button>
                     <a href="send.php" class="btn btn-link btn-block btn-lg w-100 mb-4 inv-down">Download Invoice</a>
                     <hr class="mb-4">
                     <div class="my-invoic-btn text-center">
                        <a href="#">My Invoices <span class="my-inv-num">0</span></a>
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
