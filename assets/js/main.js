$(document).ready(function(){
    // add active class on current element for tax
    $("#tax-type-selector").on('click', 'li', function () {
        $("#tax-type-selector li.active").removeClass("active");
        $(this).addClass("active");
    });

    // add active class on current element for discount
    $("#discount-type-selector").on('click', 'li', function () {
        $("#discount-type-selector li.active").removeClass("active");
        $(this).addClass("active");
    });

    // add active class on current element for shipping
    $("#shipping-type-selector").on('click', 'li', function () {
        $("#shipping-type-selector li.active").removeClass("active");
        $(this).addClass("active");
    });
});

$(document).ready(function(){
    // add discount input 
    var d = 1;
    $("#discount").click(function(){
      d++;
      $('#rates_field').append('<tr id="row'+d+'"><td width="195" align="right"><label class="m-0 mr-4">Discount</label></td><td width="195" align="right"><div class="input-group discount mb-3"><input type="number" name="discount" id="discount-input" dir="rtl" placeholder="0" autocomplete="off" class="form-control"><div class="input-group-prepend "><span class="input-group-text discount-type-dollar d-none">$</span></div><div class="input-group-append"><span class="input-group-text discount-type-prcent">%</span></div><div id="discount-type" class="input-group-append"><button class="btn dropdown-toggle tax-type-btn" type="button" id="discount-type-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button><ul class="dropdown-menu dropdown-menu-right" id="discount-type-selector" aria-labelledby="dropdownMenuButton"><li class="dropdown-item">Flat($)</li><li class="dropdown-item active">Percent(%)</li></ul></div></div></td><td width="20"><button type="button" name="remove" id="row'+d+'" class="btn btn-danger dis_btn_remove">X</button></td></tr>');  
    });

    $(document).on('click', '.dis_btn_remove', function(){
      var button_id = $(this).attr("id");
      $('#row'+button_id+'').remove();  
    });
});


// input place holder change wrt to dropdown for tax
let taxTypeDiv = document.querySelector('#tax-type-selector');
let taxType = taxTypeDiv.querySelectorAll('.dropdown-item');
taxType.forEach(taxTypeselector => {
    taxTypeselector.addEventListener('click', function(){
        let selectedtype = this.innerHTML;
        let taxInput = document.querySelector('#tax-input');
        let taxTypePercent = document.querySelector('.tax-type-prcent');
        let taxTypeDollar = document.querySelector('.tax-type-dollar');
        if (selectedtype === 'Percent(%)') {
            taxInput.setAttribute('placeholder', 0);
            taxInput.setAttribute('dir', 'rtl');
            taxTypePercent.innerHTML = '%';
            taxTypeDollar.classList.add('d-none');
        } else if(selectedtype === 'Flat($)') {
            taxTypePercent.innerHTML = '';
            taxInput.setAttribute('placeholder', '0');
            taxInput.removeAttribute('dir');
            taxTypeDollar.classList.remove('d-none');
        }
    });
});

// input place holder change wrt to dropdown for discount
let discountTypeDiv = document.querySelector('#discount-type-selector');
let discountType = discountTypeDiv.querySelectorAll('.dropdown-item');
discountType.forEach(discountTypeselector => {
    discountTypeselector.addEventListener('click', function(){
        let selectedtype = this.innerHTML;
        let discountInput = document.querySelector('#discount-input');
        let discountTypePercent = document.querySelector('.discount-type-prcent');
        let discountTypeDollar = document.querySelector('.discount-type-dollar');
        if (selectedtype === 'Percent(%)') {
            discountInput.setAttribute('placeholder', 0);
            discountInput.setAttribute('dir', 'rtl');
            discountTypePercent.innerHTML = '%';
            discountTypeDollar.classList.add('d-none');
        } else if(selectedtype === 'Flat($)') {
            discountTypePercent.innerHTML = '';
            discountInput.setAttribute('placeholder', '0');
            discountInput.removeAttribute('dir');
            discountTypeDollar.classList.remove('d-none');
        }
    });
});

// input place holder change wrt to dropdown for shipping
let shippingTypeDiv = document.querySelector('#shipping-type-selector');
let shippingType = shippingTypeDiv.querySelectorAll('.dropdown-item');
shippingType.forEach(shippingTypeselector => {
    shippingTypeselector.addEventListener('click', function(){
        let selectedtype = this.innerHTML;
        let shippingInput = document.querySelector('#shipping-input');
        let shippingTypePercent = document.querySelector('.shipping-type-prcent');
        let shippingTypeDollar = document.querySelector('.shipping-type-dollar');
        if (selectedtype === 'Percent(%)') {
            shippingInput.setAttribute('placeholder', 0);
            shippingInput.setAttribute('dir', 'rtl');
            shippingTypePercent.innerHTML = '%';
            shippingTypeDollar.classList.add('d-none');
        } else if(selectedtype === 'Flat($)') {
            shippingTypePercent.innerHTML = '';
            shippingInput.setAttribute('placeholder', '0');
            shippingInput.removeAttribute('dir');
            shippingTypeDollar.classList.remove('d-none');
        }
    });
});


