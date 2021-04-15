
   <div class="modal fade" id="print<?php echo urldecode($row['invnumber']); ?>" tabindex="-1" role="dialog" aria-labelledby="addLabel" aria-hidden="true">
      <div class="modal-dialog">
         <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title">Print Invoice</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <form action="create.php" method="post">
                  <?php
                     
                     $invid = $row['invnumber'];
                     $username = $_SESSION['username'];
                     $info = "SELECT * FROM tbl_info WHERE invnumber = '$invid' AND username = '$username'";
                     $infosql = mysqli_query($conn, $info);
                     $inforesult = mysqli_fetch_assoc($infosql);
                  ?>
                  <table class="table table-responsive pdf-table">
                     <tr>
                           <td width="650px">
                              <table class="table">
                                 <tr>
                                       <td>
                                          <img src="assets/images/zpc-logo.png" alt="">
                                       </td>
                                 </tr>
                                 <tr>
                                       <td><b><?php echo $inforesult['fromto']; ?></b></td>
                                 </tr>
                                 <tr>
                                       <td>Bill To: <br><b><?php echo $inforesult['billto']; ?></b></td>
                                       <td>Ship To: <br><b><?php echo $inforesult['shipto']; ?></b></td>
                                 </tr>
                              </table>
                           </td>
                           <td width="650px">
                              <table class="table">
                                 <tr>
                                       <td colspan="2">
                                          <div class="inv-title">
                                          <h1 class="mb-3 text-right">INVOICE</h1>
                                          <div class="inv-number">
                                             # <?php echo $inforesult['invnumber']; ?>
                                          </div>
                                       </td>
                                 </tr>
                                 <tr>
                                       <td class="text-right"><label class="mr-4">Date:</label></td>
                                       <td class="text-right"><?php echo date('F j, Y',strtotime($inforesult['invdate'])) ; ?></td>
                                 </tr>
                                 <tr>
                                       <td class="text-right"><label class="mr-4">Payment Terms:</label></td>
                                       <td class="text-right"><?php echo $inforesult['payterms']; ?></td>
                                 </tr>
                                 <tr>
                                       <td class="text-right"><label class="mr-4">Due Date:</label></td>
                                       <td class="text-right"><?php echo date('F j, Y',strtotime($inforesult['duedate'])); ?></td>
                                 </tr>
                              </table>
                           </td>
                     </tr>
                     <tr>
                           <td colspan="2">
                              <table class="table" width="100%">
                                 <thead>
                                       <tr class="item-row item-head">
                                          <th>Item</th>
                                          <th>Quantity</th>
                                          <th>Rate</th>
                                          <th class="text-right">Total</th>
                                          <th></th>
                                       </tr>
                                 </thead>
                                 <tbody>
                                       <?php
                                          $item = "SELECT * FROM tbl_item WHERE invnumber = '$invid' AND username = '$username'";
                                          $itemsql = mysqli_query($conn, $item);
                                          if (mysqli_num_rows($itemsql) > 0) {
                                             while( $itemrow = mysqli_fetch_assoc($itemsql)){
                                       ?>
                                       <tr class="item-row" id="row">
                                          <td><span class="item"><b><?php echo $itemrow['item']; ?></b></span></td>
                                          <td><span class="qty"><?php echo $itemrow['quantity']; ?></span></span></td>
                                          <td><span class="price"><?php echo $itemrow['rate']; ?></span></span></td>
                                          <td class="text-right">$<span><?php echo $itemrow['total']; ?></span></td>
                                          <td></td>
                                       </tr>
                                       <?php
                                             }
                                          }
                                       ?>
                                 </tbody>
                              </table>
                           </td>
                     </tr>
                     <tr>
                           <td colspan="2">
                           <table class="table">
                                 <tr>
                                    <td width="50%">
                                       <table width="100%">
                                          <tr>
                                             <td>
                                                <div class="notes-holder">
                                                   <div class="form-group mb-5">
                                                      <span>Notes: <br><?php echo $inforesult['notes']; ?></span>
                                                   </div>
                                                </div>
                                             </td>
                                          </tr>
                                          <tr>
                                             <td>
                                                <div class="terms-holder">
                                                   <div class="form-group">
                                                      <span>Terms: <br><?php echo $inforesult['terms']; ?></span>
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
                                             <td class="text-right">Sub Total:</td>
                                             <td class="text-right">$<span><?php echo $inforesult['subtotal']; ?></span></td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <?php
                                                if($inforesult['taxpercent'] > 0) {
                                             ?>
                                             <td class="text-right">Tax (<?php echo $inforesult['taxpercent']; ?>%):</td>
                                             <td>
                                                <div class="text-right">
                                                   <span class="taxpercent"><?php echo ($inforesult['subtotal'] * $inforesult['taxpercent']) / 100; ?></span>
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                             <?php
                                                if($inforesult['taxflat'] > 0) {
                                             ?>
                                             <td class="text-right">Tax:</td>
                                             <td>
                                                <div class="text-right">
                                                   <span class="taxflat">$<?php echo $inforesult['taxflat']; ?></span>
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <?php
                                                   if($inforesult['discountpercent'] > 0) {
                                             ?>
                                             <td class="text-right">Discount (<?php echo $inforesult['discountpercent']; ?>%):</td>
                                             <td>
                                                <div class="text-right">
                                                   <span class="discountpercent"><?php echo ($inforesult['subtotal'] * $inforesult['discountpercent']) / 100; ?></span>
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                             <?php
                                                if($inforesult['discountflat'] > 0) {
                                             ?>
                                             <td class="text-right">Discount:</td>
                                             <td>
                                                <div class="text-right">
                                                   $<span class="discountflat"><?php echo $inforesult['discountflat']; ?></span>
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <?php
                                                if($inforesult['shippingpercent'] > 0) {
                                             ?>
                                             <td class="text-right">Shipping (<?php echo $inforesult['shippingpercent']; ?>%):</td>
                                             <td>
                                                <div class="text-right">
                                                   <span class="shippingpercent"><?php echo ($inforesult['subtotal'] * $inforesult['shippingpercent']) / 100; ?></span>%
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                             <?php
                                                if($inforesult['shippingflat'] > 0) {
                                             ?>
                                             <td class="text-right">Shipping:</td>
                                             <td>
                                                <div class="text-right">
                                                   $<span class="shippingflat"><?php echo $inforesult['shippingflat']; ?></span>
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-right">Total:</td>
                                             <td class="text-right">$ <span class="grandtotal"><?php echo $inforesult['grandtotal']; ?></span></td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-right">Amount Paid:</td>
                                             <td class="text-right">$ <span class="paidamount"><?php echo $inforesult['paidamount']; ?></span></td>
                                             <td></td>
                                          </tr>
                                          <tr>
                                             <td></td>
                                             <td></td>
                                             <td class="text-right">Balance Due:</td>
                                             <td class="text-right">$ <span class="duebalance"><?php echo $inforesult['duebalance']; ?></td>
                                             <td></td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                           </td>
                     </tr>
                  </table>
                  <button name="print-btn" type="submit"  class="btn btn-primary print-btn" onclick="print();">Print or Download</button>
                  </form>
               </div>
         </div>
      </div>
   </div>




