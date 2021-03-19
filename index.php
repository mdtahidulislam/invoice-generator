<?php include('header.php'); ?>


<!------------------------->
<!---- START MAIN AREA ---->
<main>
	<!--========================== START  SECTION ==========================-->
	<section class="">
		<div class="container">
			<form action="" class="invoice" enctype="multipart/formdata">
            <div class="row">
               <div class="col-md-9 col-sm-12 inv-info">
                  <div class="row">
                     <div class="col">
                        <div class="inv-info__contact">
                           <div class="inv-file-input form-group">
                              <input type="file" name="logo" class="inv-file-input">
                              <label class="inv-file-label" for="customFile">+ Add Your Logo</label>
                           </div>
                           <div class="form-group">
                              <textarea name="customer_msg" rows="2" class="form-control" placeholder="Who is this invoice from? (required)"></textarea>
                           </div>
                           <div class="form-group">
                              <div class="row">
                                 <div class="col-sm-6">
                                    <label> Bill To</label>
                                    <textarea type="text" name="billto" class="form-control" placeholder="Who is this invoice to? (required)"></textarea>
                                 </div>
                                 <div class="col-sm-6">
                                    <label> Ship To</label>
                                    <textarea type="text" name="shipto" class="form-control" placeholder="(Optional)"></textarea>
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
                                 <input type="text" dir="rtl" name="inv_num" class="form-control inv-num-input" placeholder="1">
                              </div>
                           </div>
                        </div>
                        <div class="inv-details d-flex justify-content-end">
                           <table>
                              <tr>
                                 <td><label class="mr-4">Date</label></td>
                                 <td><input type="text" name="date" id="date-datepicker" class="form-control mb-3" required></td>
                              </tr>
                              <tr>
                                 <td><label class="mr-4">Payment Terms</label></td>
                                 <td><input type="text" name="date" class="form-control mb-3" required></td>
                              </tr>
                              <tr>
                                 <td><label class="mr-4">Due Date</label></td>
                                 <td><input type="text" name="date" id="due-datepicker" class="form-control mb-3" required></td>
                              </tr>
                           </table>
                        </div>
                     </div>
                  </div>
                  <!-- items holder -->
                  <div class="row">
                     <div class="col">
                        <div class="table-responsive-sm">
                           <table class="table" id="dynamic_field">
                              <thead class="thead-dark">
                                 <tr>
                                    <th scope="col">Item</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col"></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr>
                                    <td width="500">
                                       <input type="text" name="item_name[]" placeholder="Description of service or product..." class="form-control" required>
                                    </td>
                                    <td width="150">
                                       <input type="number" name="item_qty[]" class="form-control" required autocomplete="off" placeholder="Quantity">
                                    </td>
                                    <td width="200">
                                       <input type="number" name="item_rate[]" class="form-control" placeholder="Rate" required>
                                    </td>
                                    <td width="150" align="right">
                                       <span class="amount">$0.00</span>
                                    </td>
                                    <td></td>
                                 </tr>
                              </tbody>
                           </table>
                           <button type="button" name="add" id="add" class="btn btn-primary mb-4">+ Line Item</button>
                        </div>
                     </div>
                  </div>
                  <div class="row">
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
                                 <td width="195" align="right"><span class="mb-3">$0.00</span></td>
                                 <td width="20"></td>
                              </tr>
                              <tr>
                                 <td width="195" align="right"><label class="mr-4">Tax</label></td>
                                 <td width="195" align="right">
                                    <div class="input-group tax mb-3">
                                       <input type="number" name="tax" id="tax-input" dir="rtl" placeholder="0" autocomplete="off" class="form-control">
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
                              <tr>
                                 <td width="195" align="right"><label class="m-0 mr-4">Discount</label></td>
                                 <td width="195" align="right">
                                    <div class="input-group discount mb-3">
                                       <input type="number" name="discount" id="discount-input" dir="rtl" placeholder="0" autocomplete="off" class="form-control">
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
                                 <td width="20"></td>
                              </tr>
                              <tr>
                                 <td width="195" align="right"><label class="m-0 mr-4">Shipping</label></td>
                                 <td width="195" align="right">
                                    <div class="input-group shipping mb-3">
                                       <input type="number" name="shipping" id="shipping-input" dir="rtl" placeholder="0" autocomplete="off" class="form-control">
                                       <div class="input-group-prepend ">
                                          <span class="input-group-text shipping-type-dollar d-none">$</span>
                                       </div>
                                       <div class="input-group-append">
                                          <span class="input-group-text shipping-type-prcent">%</span>
                                       </div>
                                       <div id="shipping-type" class="input-group-append">
                                          <button class="btn dropdown-toggle shipping-type-btn" type="button" id="shipping-type-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          </button>
                                          <ul class="dropdown-menu dropdown-menu-right" id="shipping-type-selector" aria-labelledby="dropdownMenuButton">
                                             <li class="dropdown-item">Flat($)</li>
                                             <li class="dropdown-item active">Percent(%)</li>
                                          </ul>
                                       </div>
                                    </div>
                                 </td>
                                 <td width="20"></td>
                              </tr>
                           </table>
                        </div>
                        <table>
                           <tr>
                              <td></td>
                              <td width="195" align="right">
                                 <button type="button" id="discount" class="btn btn-primary mb-4">+ Discount</button>
                                 <button type="button" id="shipping" class="btn btn-primary mb-4">+ Shipping</button>
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="col-md-3 col-sm-12">
                  <p>safjahsgjh</p>
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
