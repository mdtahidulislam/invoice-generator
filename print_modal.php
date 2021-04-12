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
                <?php
                    $invid = $row['invnumber'];
                    $username = $_SESSION['username'];
                    $info = "SELECT * FROM tbl_info WHERE invnumber = '$invid' AND username = '$username'";
                    $infosql = mysqli_query($conn, $info);
                    $inforesult = mysqli_fetch_assoc($infosql);
                ?>
                <table class="table table-responsive">
                    <tr>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <img src="assets/images/zpc-logo.png" alt="">
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo $inforesult['fromto']; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo $inforesult['billto']; ?></td>
                                    <td><?php echo $inforesult['shipto']; ?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table>
                                <tr>
                                    <td>
                                        <div class="inv-title">
                                        <h1 class="mb-3 text-right">INVOICE</h1>
                                        <div class="inv-number">
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">#</span>
                                                </div>
                                                <input type="text" dir="rtl" name="inv_num" class="form-control inv-num-input" value="<?php echo $inforesult['invnumber']; ?>" readonly>
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td><label class="mr-4">Date</label></td>
                                    <td><?php echo $inforesult['invdate']; ?></td>
                                </tr>
                                <tr>
                                    <td><label class="mr-4">Payment Terms</label></td>
                                    <td><?php echo $inforesult['payterms']; ?></td>
                                </tr>
                                <tr>
                                    <td><label class="mr-4">Due Date</label></td>
                                    <td><?php echo $inforesult['duedate']; ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="table" width="100%">
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
                                    <?php
                                        $item = "SELECT * FROM tbl_item WHERE invnumber = '$invid' AND username = '$username'";
                                        $itemsql = mysqli_query($conn, $item);
                                        if (mysqli_num_rows($itemsql) > 0) {
                                            while( $itemrow = mysqli_fetch_assoc($itemsql)){
                                    ?>
                                    <tr class="item-row" id="row">
                                        <td><span class="item"><?php echo $itemrow['item']; ?></span></td>
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
                                                   <span><?php echo $inforesult['notes']; ?></span>
                                                </div>
                                             </div>
                                          </td>
                                       </tr>
                                       <tr>
                                          <td>
                                             <div class="terms-holder">
                                                <div class="form-group">
                                                    <span><?php echo $inforesult['terms']; ?></span>
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
                                          <?php
                                              $totalcol = "SELECT sum(total) AS subtotal FROM tbl_item WHERE invnumber = '$invid' AND username = '$username'";
                                              $totalcolmysql = mysqli_query($conn, $totalcol);
                                              $totalcolf = mysqli_fetch_assoc($totalcolmysql);
                                              $subtotal = $totalcolf['subtotal'];
                                          ?>
                                          <td class="text-right">$<span><?php echo $subtotal; ?></span></td>
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
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button onclick="print()" class="btn btn-primary">Print</button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.modal -->



