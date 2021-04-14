(function (jQuery) {
    $.opt = {};  // jQuery Object

    jQuery.fn.invoice = function (options) {
        var ops = jQuery.extend({}, jQuery.fn.invoice.defaults, options);
        $.opt = ops;

        var inv = new Invoice();
        inv.init();

        jQuery('body').on('click', function (e) {
            var cur = e.target.id || e.target.className;

            if (cur == $.opt.addRow.substring(1))
                inv.newRow();

            if (cur == $.opt.delete.substring(1))
                inv.deleteRow(e.target);

            inv.init();
        });

        jQuery('body').on('keyup', function (e) {
            inv.init();
        });

        return this;
    };
}(jQuery));

function Invoice() {
    self = this;
}

Invoice.prototype = {
    constructor: Invoice,

    init: function () {
        this.calcTotal();
        this.calcTotalQty();
        this.calcSubtotal();
        this.calcGrandTotal();
    },

    /**
     * Calculate total price of an item.
     *
     * @returns {number}
     */
    calcTotal: function () {
         jQuery($.opt.parentClass).each(function (i) {
             var row = jQuery(this);
             var total = row.find($.opt.price).val() * row.find($.opt.qty).val();

             total = self.roundNumber(total, 2);

             row.find($.opt.total).html(total);
         });

         return 1;
     },
	
    /***
     * Calculate total quantity of an order.
     *
     * @returns {number}
     */
    calcTotalQty: function () {
         var totalQty = 0;
         jQuery($.opt.qty).each(function (i) {
             var qty = jQuery(this).val();
             if (!isNaN(qty)) totalQty += Number(qty);
         });

         totalQty = self.roundNumber(totalQty, 2);

         jQuery($.opt.totalQty).html(totalQty);

         return 1;
     },

    /***
     * Calculate subtotal of an order.
     *
     * @returns {number}
     */
    calcSubtotal: function () {
         var subtotal = 0;
         jQuery($.opt.total).each(function (i) {
             var total = jQuery(this).html();
             if (!isNaN(total)) subtotal += Number(total);
         });

         subtotal = self.roundNumber(subtotal, 2);

         jQuery($.opt.subtotal).val(subtotal);

         return 1;
     },

    /**
     * Calculate grand total of an order.
     *
     * @returns {number}
     */
    calcGrandTotal: function () {
        var disVal = $('.discount-input').val();
        var taxVal = $('.tax-input').val();
        var shipVal = $('.shipping-input').val();
        var activeType = $('li.active');
        activeType.each(function(){
            
            var $taxactiveText = $('ul#tax-type-selector li.active').text();

            

            // if ($activeText === 'Percent(%)') {
            //     dispercent = (disVal / 100);
            //     var grandTotal = Number(jQuery($.opt.subtotal).val())
            //            - Number(dispercent)
            //            + Number(jQuery($.opt.shipping).val());
            //         grandTotal = self.roundNumber(grandTotal, 2);
            //         jQuery($.opt.grandTotal).html(grandTotal);
            // } else if ($activeText === 'Flat($)'){
            //     disFlat = Number(disVal);
            //     var grandTotal = Number(jQuery($.opt.subtotal).val())
            //             - Number(disFlat)
            //             + Number(jQuery($.opt.shipping).val());
            //         grandTotal = self.roundNumber(grandTotal, 2);
            //         jQuery($.opt.grandTotal).html(grandTotal);
            // } 

            if ($taxactiveText === 'Percent(%)') {
                taxpercent = (taxVal * Number(jQuery($.opt.subtotal).val())) / 100;
                var $disactiveText = $('ul#discount-type-selector li.active').text();
                if ($disactiveText === 'Percent(%)') {
                    //dispercent = (disVal / 100);
                    dispercent = (disVal * Number(jQuery($.opt.subtotal).val())) / 100;
                    var $shipactiveText = $('ul#shipping-type-selector li.active').text();
                    if ($shipactiveText === 'Percent(%)') {
                        //shippercent = (shipVal / 100);
                        shippercent = (shipVal * Number(jQuery($.opt.subtotal).val())) / 100;
                        var grandTotal = Number(jQuery($.opt.subtotal).val())
                                + Number(taxpercent)
                                - Number(dispercent)
                                + Number(shippercent);
                            grandTotal = self.roundNumber(grandTotal, 2);
                            jQuery($.opt.grandTotal).val(grandTotal);

                            // resize input length according to value
                            var input = document.querySelector('#grandTotal'); 
                            input.style.width = input.value.length + "ch";

                        var paidAmount = Number($('.payment-input').val());
                        var dueBalance = Number(grandTotal - paidAmount);
                        dueBalance = self.roundNumber(dueBalance, 2);
                        jQuery($.opt.duebalance).val(dueBalance);

                        // resize input length according to value
                        var dbinput = document.querySelector('#duebalance'); 
                        dbinput.style.width = dbinput.value.length + "ch";
                        // resize input length according to value
                        var subtotalinput = document.querySelector('#subtotal'); 
                        subtotalinput.style.width = subtotalinput.value.length + "ch";

                    } else if ($shipactiveText === 'Flat($)') {
                        shipFlat = Number(shipVal);
                        var grandTotal = Number(jQuery($.opt.subtotal).val())
                                + Number(taxpercent)
                                - Number(dispercent)
                                + Number(shipFlat);
                            grandTotal = self.roundNumber(grandTotal, 2);
                            jQuery($.opt.grandTotal).val(grandTotal);

                            // resize input length according to value
                            var input = document.querySelector('#grandTotal'); 
                            input.style.width = input.value.length + "ch";

                        var paidAmount = Number($('.payment-input').val());
                        var dueBalance = Number(grandTotal - paidAmount);
                        dueBalance = self.roundNumber(dueBalance, 2);
                        jQuery($.opt.duebalance).val(dueBalance);

                        // resize input length according to value
                        var dbinput = document.querySelector('#duebalance'); 
                        dbinput.style.width = dbinput.value.length + "ch"; 

                    }
                    
                } else if ($disactiveText === 'Flat($)') {
                    disFlat = Number(disVal);
                    var $shipactiveText = $('ul#shipping-type-selector li.active').text();
                    if ($shipactiveText === 'Percent(%)') {
                        //shippercent = (shipVal / 100);
                        shippercent = (shipVal * Number(jQuery($.opt.subtotal).val())) / 100;
                        var grandTotal = Number(jQuery($.opt.subtotal).val())
                                + Number(taxpercent)
                                - Number(disFlat)
                                + Number(shippercent);
                            grandTotal = self.roundNumber(grandTotal, 2);
                            jQuery($.opt.grandTotal).val(grandTotal);

                            // resize input length according to value
                            var input = document.querySelector('#grandTotal'); 
                            input.style.width = input.value.length + "ch";

                        var paidAmount = Number($('.payment-input').val());
                        var dueBalance = Number(grandTotal - paidAmount);
                        dueBalance = self.roundNumber(dueBalance, 2);
                        jQuery($.opt.duebalance).val(dueBalance);

                        // resize input length according to value
                        var dbinput = document.querySelector('#duebalance'); 
                        dbinput.style.width = dbinput.value.length + "ch";

                    } else if ($shipactiveText === 'Flat($)') {
                        shipFlat = Number(shipVal);
                        var grandTotal = Number(jQuery($.opt.subtotal).val())
                                + Number(taxpercent)
                                - Number(disFlat)
                                + Number(shipFlat);
                            grandTotal = self.roundNumber(grandTotal, 2);
                            jQuery($.opt.grandTotal).val(grandTotal);

                            // resize input length according to value
                            var input = document.querySelector('#grandTotal'); 
                            input.style.width = input.value.length + "ch";

                        var paidAmount = Number($('.payment-input').val());
                        var dueBalance = Number(grandTotal - paidAmount); 
                        dueBalance = self.roundNumber(dueBalance, 2);
                        jQuery($.opt.duebalance).val(dueBalance);

                        // resize input length according to value
                        var dbinput = document.querySelector('#duebalance'); 
                        dbinput.style.width = dbinput.value.length + "ch";
                    }
                }
                
            } else if ($taxactiveText === 'Flat($)'){
                taxFlat = Number(taxVal);
                var $disactiveText = $('ul#discount-type-selector li.active').text();
                if ($disactiveText === 'Percent(%)') {
                    //dispercent = (disVal / 100);
                    dispercent = (disVal * Number(jQuery($.opt.subtotal).val())) / 100;
                    var $shipactiveText = $('ul#shipping-type-selector li.active').text();
                    if ($shipactiveText === 'Percent(%)') {
                        //shippercent = (shipVal / 100);
                        shippercent = (shipVal * Number(jQuery($.opt.subtotal).val())) / 100;
                        var grandTotal = Number(jQuery($.opt.subtotal).val())
                                + Number(taxFlat)
                                - Number(dispercent)
                                + Number(shippercent);
                            grandTotal = self.roundNumber(grandTotal, 2);
                            jQuery($.opt.grandTotal).val(grandTotal);

                            // resize input length according to value
                            var input = document.querySelector('#grandTotal'); 
                            input.style.width = input.value.length + "ch";

                        var paidAmount = Number($('.payment-input').val());
                        var dueBalance = Number(grandTotal - paidAmount);
                        dueBalance = self.roundNumber(dueBalance, 2);
                        jQuery($.opt.duebalance).val(dueBalance);

                        // resize input length according to value
                        var dbinput = document.querySelector('#duebalance'); 
                        dbinput.style.width = dbinput.value.length + "ch";

                    } else if ($shipactiveText === 'Flat($)') {
                        shipFlat = Number(shipVal);
                        var grandTotal = Number(jQuery($.opt.subtotal).val())
                                + Number(taxFlat)
                                - Number(dispercent)
                                + Number(shipFlat);
                            grandTotal = self.roundNumber(grandTotal, 2);
                            jQuery($.opt.grandTotal).val(grandTotal);

                            // resize input length according to value
                            var input = document.querySelector('#grandTotal'); 
                            input.style.width = input.value.length + "ch";

                        var paidAmount = Number($('.payment-input').val());
                        var dueBalance = Number(grandTotal - paidAmount);
                        dueBalance = self.roundNumber(dueBalance, 2);
                        jQuery($.opt.duebalance).val(dueBalance);

                        // resize input length according to value
                        var dbinput = document.querySelector('#duebalance'); 
                        dbinput.style.width = dbinput.value.length + "ch";
                    }
                } else if ($disactiveText === 'Flat($)') {
                    disFlat = Number(disVal);
                    var $shipactiveText = $('ul#shipping-type-selector li.active').text();
                    if ($shipactiveText === 'Percent(%)') {
                        //shippercent = (shipVal / 100);
                        shippercent = (shipVal * Number(jQuery($.opt.subtotal).val())) / 100;
                        var grandTotal = Number(jQuery($.opt.subtotal).val())
                                + Number(taxFlat)
                                - Number(disFlat)
                                + Number(shippercent);
                            grandTotal = self.roundNumber(grandTotal, 2);
                            jQuery($.opt.grandTotal).val(grandTotal);

                            // resize input length according to value
                            var input = document.querySelector('#grandTotal'); 
                            input.style.width = input.value.length + "ch";

                        var paidAmount = Number($('.payment-input').val());
                        var dueBalance = Number(grandTotal - paidAmount);
                        dueBalance = self.roundNumber(dueBalance, 2);
                        jQuery($.opt.duebalance).val(dueBalance);

                        // resize input length according to value
                        var dbinput = document.querySelector('#duebalance'); 
                        dbinput.style.width = dbinput.value.length + "ch";
                    } else if ($shipactiveText === 'Flat($)') {
                        shipFlat = Number(shipVal);
                        var grandTotal = Number(jQuery($.opt.subtotal).val())
                                + Number(taxFlat)
                                - Number(disFlat)
                                + Number(shipFlat);
                            grandTotal = self.roundNumber(grandTotal, 2);
                            jQuery($.opt.grandTotal).val(grandTotal);

                            // resize input length according to value
                            var input = document.querySelector('#grandTotal'); 
                            input.style.width = input.value.length + "ch";

                        var paidAmount = Number($('.payment-input').val());
                        var dueBalance = Number(grandTotal - paidAmount);
                        dueBalance = self.roundNumber(dueBalance, 2);
                        jQuery($.opt.duebalance).val(dueBalance);

                        // resize input length according to value
                        var dbinput = document.querySelector('#duebalance'); 
                        dbinput.style.width = dbinput.value.length + "ch";
                    }
                }
            } 
        });
        

        //jQuery($.opt.grandTotal).html(grandTotal);

        return 1;
    },

    /**
     * Add a row.
     *
     * @returns {number}
     */
    newRow: function () {
        jQuery(".item-row:last").after('<tr class="item-row"><td class="item-name"><div class="delete-btn"><input type="text" class="form-control item" placeholder="Item" type="text"><a class=' + $.opt.delete.substring(1) + ' href="javascript:;" title="Remove row">X</a></div></td><td><input class="form-control price" placeholder="Price" type="text"> </td><td><input class="form-control qty" placeholder="Quantity" type="text"></td><td><span class="total">0.00</span></td></tr>');
		
        if (jQuery($.opt.delete).length > 0) {
            jQuery($.opt.delete).show();
        }

        return 1;
    },

    /**
     * Delete a row.
     *
     * @param elem   current element
     * @returns {number}
     */
    deleteRow: function (elem) {
        jQuery(elem).parents($.opt.parentClass).remove();

        if (jQuery($.opt.delete).length < 2) {
            jQuery($.opt.delete).hide();
        }

        return 1;
    },

    /**
     * Round a number.
     * Using: http://www.mediacollege.com/internet/javascript/number/round.html
     *
     * @param number
     * @param decimals
     * @returns {*}
     */
    roundNumber: function (number, decimals) {
        var newString;// The new rounded number
        decimals = Number(decimals);

        if (decimals < 1) {
            newString = (Math.round(number)).toString();
        } else {
            var numString = number.toString();

            if (numString.lastIndexOf(".") == -1) {// If there is no decimal point
                numString += ".";// give it one at the end
            }

            var cutoff = numString.lastIndexOf(".") + decimals;// The point at which to truncate the number
            var d1 = Number(numString.substring(cutoff, cutoff + 1));// The value of the last decimal place that we'll end up with
            var d2 = Number(numString.substring(cutoff + 1, cutoff + 2));// The next decimal, after the last one we want

            if (d2 >= 5) {// Do we need to round up at all? If not, the string will just be truncated
                if (d1 == 9 && cutoff > 0) {// If the last digit is 9, find a new cutoff point
                    while (cutoff > 0 && (d1 == 9 || isNaN(d1))) {
                        if (d1 != ".") {
                            cutoff -= 1;
                            d1 = Number(numString.substring(cutoff, cutoff + 1));
                        } else {
                            cutoff -= 1;
                        }
                    }
                }

                d1 += 1;
            }

            if (d1 == 10) {
                numString = numString.substring(0, numString.lastIndexOf("."));
                var roundedNum = Number(numString) + 1;
                newString = roundedNum.toString() + '.';
            } else {
                newString = numString.substring(0, cutoff) + d1.toString();
            }
        }

        if (newString.lastIndexOf(".") == -1) {// Do this again, to the new string
            newString += ".";
        }

        var decs = (newString.substring(newString.lastIndexOf(".") + 1)).length;

        for (var i = 0; i < decimals - decs; i++)
            newString += "0";
        //var newNumber = Number(newString);// make it a number if you like

        return newString; // Output the result to the form field (change for your purposes)
    }
};

/**
 *  Publicly accessible defaults.
 */
jQuery.fn.invoice.defaults = {
    addRow: "#addRow",
    delete: ".delete",
    parentClass: ".item-row",

    price: ".price",
    qty: ".qty",
    total: ".total",
    totalQty: "#totalQty",

    subtotal: "#subtotal",
    tax : "#tax",
    discount: "#discount",
    shipping: "#shipping",
    grandTotal: "#grandTotal",
    duebalance : "#duebalance"
};
