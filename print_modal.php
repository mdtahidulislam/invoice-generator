
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
                  <form action="create.php" method="post" class="modal-table-form">
                  <?php
                     
                     $invid = $row['invnumber'];
                     $username = $_SESSION['username'];
                     $info = "SELECT * FROM tbl_info WHERE invnumber = '$invid' AND username = '$username'";
                     $infosql = mysqli_query($conn, $info);
                     $inforesult = mysqli_fetch_assoc($infosql);
                  ?>
                  <table class="table pdf-table">
                     <tr class="res-logo">
                        <td width="650px">
                           <table class="table">
                              <tr>
                                 <td>
                                    <?php 
                                       $logoquery = "SELECT logo FROM tbl_logo WHERE username = '$username'";
                                       $logosql = mysqli_query($conn, $logoquery);
                                       $logoresult = mysqli_fetch_assoc($logosql);
                                    ?>
                                    <div class="local-img" >
                                       <img class="img-fluid" src="<?php echo $logoresult['logo']; ?>">
                                    </div>
                                 </td>
                              </tr>
                              <tr class="res-bill-ship">
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
                                    <td class="text-right"><label class="mr-4 res-label">Date:</label></td>
                                    <td class="text-right"><?php echo date('F j, Y',strtotime($inforesult['invdate'])) ; ?></td>
                              </tr>
                              <tr>
                                    <td class="text-right"><label class="mr-4 res-label">Payment Terms:</label></td>
                                    <td class="text-right"><?php echo $inforesult['payterms']; ?></td>
                              </tr>
                              <tr>
                                    <td class="text-right"><label class="mr-4 res-label">Due Date:</label></td>
                                    <td class="text-right"><?php echo date('F j, Y',strtotime($inforesult['duedate'])); ?></td>
                              </tr>
                           </table>
                        </td>
                     </tr>
                  </table>
                  <!-- <table class="table table-responsive">
                     <tr>
                        <td colspan="2"> -->
                        <div class="res-scroll">
                           <table class="table">
                              <thead>
                                    <tr class="item-row item-head">
                                       <th>Item</th>
                                       <th>Quantity</th>
                                       <th>Rate</th>
                                       <th class="text-right">Total</th>
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
                                       <td width="350"><span class="item"><b><?php echo $itemrow['item']; ?></b></span></td>
                                       <td width="100"><span class="qty"><?php echo $itemrow['quantity']; ?></span></span></td>
                                       <td width="200"><span class="price"><?php echo $itemrow['rate']; ?></span></span></td>
                                       <td width="200" class="text-right">$<span><?php echo $itemrow['total']; ?></span></td>
                                    </tr>
                                    <?php
                                          }
                                       }
                                    ?>
                              </tbody>
                           </table>
                        </div>
                        <!-- </td>
                     </tr>
                  </table> -->
                  <table class="table">
                     <tr>
                        <td colspan="2">
                           <table class="table">
                                 <tr class="res-notes-terms">
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
                                             <!-- <td></td>
                                             <td></td>
                                             <td></td> -->
                                             <td class="text-right">Sub Total:</td>
                                             <td class="text-right">$<span><?php echo $inforesult['subtotal']; ?></span></td>
                                          </tr>
                                          <tr>
                                             <!-- <td></td>
                                             <td></td>
                                             <td></td> -->
                                             <?php
                                                if($inforesult['taxpercent'] > 0) {
                                             ?>
                                             <td class="text-right">Tax (<?php echo $inforesult['taxpercent']; ?>%):</td>
                                             <td>
                                                <div class="text-right">
                                                $ <span class="taxpercent"><?php echo ($inforesult['subtotal'] * $inforesult['taxpercent']) / 100; ?></span>
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
                                                   $ <span class="taxflat"><?php echo $inforesult['taxflat']; ?></span>
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                          </tr>
                                          <tr>
                                             <!-- <td></td>
                                             <td></td>
                                             <td></td> -->
                                             <?php
                                                   if($inforesult['discountpercent'] > 0) {
                                             ?>
                                             <td class="text-right">Discount (<?php echo $inforesult['discountpercent']; ?>%):</td>
                                             <td>
                                                <div class="text-right">
                                                $ <span class="discountpercent"><?php echo ($inforesult['subtotal'] * $inforesult['discountpercent']) / 100; ?></span>
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
                                                   $ <span class="discountflat"><?php echo $inforesult['discountflat']; ?></span>
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                          </tr>
                                          <tr>
                                             <!-- <td></td>
                                             <td></td>
                                             <td></td> -->
                                             <?php
                                                if($inforesult['shippingpercent'] > 0) {
                                             ?>
                                             <td class="text-right">Shipping (<?php echo $inforesult['shippingpercent']; ?>%):</td>
                                             <td>
                                                <div class="text-right">
                                                   $ <span class="shippingpercent"><?php echo ($inforesult['subtotal'] * $inforesult['shippingpercent']) / 100; ?></span>%
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
                                                   $ <span class="shippingflat"><?php echo $inforesult['shippingflat']; ?></span>
                                                </div>
                                             </td>
                                             <?php      
                                                };
                                             ?>
                                          </tr>
                                          <tr>
                                             <!-- <td></td>
                                             <td></td>
                                             <td></td> -->
                                             <td class="text-right">Total:</td>
                                             <td class="text-right">$ <span class="grandtotal"><?php echo $inforesult['grandtotal']; ?></span></td>
                                          </tr>
                                          <tr>
                                             <!-- <td></td>
                                             <td></td>
                                             <td></td> -->
                                             <td class="text-right">Amount Paid:</td>
                                             <td class="text-right">$ <span class="paidamount"><?php echo $inforesult['paidamount']; ?></span></td>
                                          </tr>
                                          <tr>
                                             <!-- <td></td>
                                             <td></td>
                                             <td></td> -->
                                             <td class="text-right">Balance Due:</td>
                                             <td class="text-right">$ <span class="duebalance"><?php echo $inforesult['duebalance']; ?></td>
                                          </tr>
                                       </table>
                                    </td>
                                 </tr>
                              </table>
                        </td>
                     </tr>
                     <tr class="res-signature">
                        <td>From To: <b><?php echo $inforesult['fromto']; ?></b></td>
                        <td>
                           <?php
                              $username =   $_SESSION['username'];
                              $sig = "SELECT * FROM tbl_user WHERE username = '$username'";
                              $sigsql = mysqli_query($conn, $sig);
                              $sigresult = mysqli_fetch_assoc($sigsql);
                              if (!empty($sigresult['signature'])) {
                           ?>
                           <div class="signature text-right">
                              <img src="assets/images/signature/<?php echo $sigresult['signature']; ?>" alt="signature" class="img-fluid">
                              <hr>
                              <p class="mb-0"><?php echo $sigresult['company']; ?></p>
                              <p class="mb-0"><?php echo $sigresult['mobile']; ?></p>
                           </div>
                           <?php
                              }
                           ?>
                        </td>
                     </tr>
                  </table>
                  <button name="print-btn" type="submit"  class="btn btn-primary print-btn" onclick="print();">Print or Download</button>
                  </form>
               </div>
         </div>
      </div>
   </div>




