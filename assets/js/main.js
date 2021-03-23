$(document).ready(function(){
    // file name show
    $('.inv-file-input').on('change',  function(e){
        // show slected file name as label
        //let fileName = $(this).val().split('\\').pop();
        //$(this).siblings('.inv-file-label').addClass('selected').html(fileName);
        // show image preview
        const imgFile = this.files[0];
        if (imgFile) {
            let reader = new FileReader();
            reader.onload = (e)=>{
                $('.preview-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(imgFile);
        }
        $('.inv-file-input').addClass('d-none');
        $('.preview').removeClass('d-none');

        // close image preview
        $('.close-img').on('click', ()=>{
            $('.preview').addClass('d-none');
            $('.inv-file-input').removeClass('d-none');
            $('.inv-file-input').val('');
            //$('.inv-file-input').siblings('.inv-file-label').addClass('selected').html('+ Add Your Logo');
        });
    });

    /* ==========================================================
                        For tax dropdown type
    =========================================================== */
    // add active class on current element for tax
    $("#tax-type-selector").on('click', 'li', function () {
        $("#tax-type-selector li.active").removeClass("active");
        $(this).addClass("active");
    });
    // input place holder change wrt to dropdown for tax
    let taxTypeDiv = document.querySelector('#tax-type-selector');
    let taxType = taxTypeDiv.querySelectorAll('.dropdown-item');
    taxType.forEach(taxTypeselector => {
        taxTypeselector.addEventListener('click', function(){
            var selectedtype = this.innerHTML;
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

    /* ==========================================================
            For Discount and shipping row show/hide
    =========================================================== */
    // discount row show and hidden
    let inputTypeRow = document.querySelectorAll('.input-type-row');
    let showBtn = document.querySelectorAll('.show-btn');
    let deleteBtn = document.querySelectorAll('.delete-btn');
    for (let i = 0; i < showBtn.length; i++) {
        showBtn[i].addEventListener('click', ()=>{
            showBtn[i].classList.add('d-none');
            for (let j = 0; j < inputTypeRow.length; j++) {
                inputTypeRow[i].classList.remove('d-none');
            }
        });
    }
    for (let i = 0; i < deleteBtn.length; i++) {
        deleteBtn[i].addEventListener('click', ()=>{
            deleteBtn[i].classList.add('d-none');
            for (let j = 0; j < inputTypeRow.length; j++) {
                inputTypeRow[i].classList.add('d-none');
            }
            for (let i = 0; i < showBtn.length; i++) {
                showBtn[i].classList.remove('d-none');
            }
        });
    }

    /* ==========================================================
                        For discount dropdown type
    =========================================================== */
    // add active class on current element for discount
    $("#discount-type-selector").on('click', 'li', function () {
        $("#discount-type-selector li.active").removeClass("active");
        $(this).addClass("active");
    });

    // input place holder change wrt to dropdown for discount 
    let discountTypeDiv = document.getElementById('discount-type-selector');
    console.log(discountTypeDiv);
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

    /* ==========================================================
                        For Shipping dropdown type
    =========================================================== */
    // add active class on current element for shipping
    $("#shipping-type-selector").on('click', 'li', function () {
        $("#shipping-type-selector li.active").removeClass("active");
        $(this).addClass("active");
    });
    // input place holder change wrt to dropdown for shipping 
    let shippingTypeDiv = document.getElementById('shipping-type-selector');
    console.log(discountTypeDiv);
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
});


/* ==========================================================
                    calculation
=========================================================== */
    
$(document).ready(function(){
    
    $(".txtMult input").keyup(multInputs);
    function multInputs() {
        
        var mult = 0;
        var taxVal = 0;
        // for each row:
        $("tr.txtMult").each(function () {
            // get the values from this row:
            var $val1 = $('.val1', this).val();
            var $val2 = $('.val2', this).val();
            var $total = ($val1 * 1) * ($val2 * 1)
            $('.multTotal',this).text($total);
            mult += $total;
        });
        $(".subtotal").text(mult);
        
        // tax calculation
        $('.tax-input').keyup(()=>{
            var taxVal = $('.tax-input').val();
            var activeType = $('li.active');
            activeType.each(function(){
                var $activeText = $('ul#tax-type-selector li.active').text();
                if ($activeText === 'Percent(%)') {
                    $taxpercent = ( taxVal / 100) ;
                    mult += $taxpercent;
                    console.log(mult);
                } else if ($activeText === 'Flat($)'){
                    taxFlat  =  parseInt(taxVal);
                } 
            });
        });
        
        // $('.tax-input').keyup(()=>{
        //     var taxVal = $('.tax-input').val();
        //     var activeType = $('li.active');
        //     activeType.each(function(){
        //         var $activeText = $('ul#tax-type-selector li.active').text();
        //         if ($activeText === 'Percent(%)') {
        //             $taxpercent = ( taxVal / 100) ;
        //             mult += $taxpercent;
        //             console.log(mult);
        //         } else if ($activeText === 'Flat($)'){
        //             taxFlat  =  parseInt(taxVal);
        //         } 
        //     });
        // });
        
        // discount calculation
        // $('.discount-input').keyup(()=>{
        //     var disVal = $('.discount-input').val();
        //     var activeType = $('li.active');
        //     activeType.each(function(){
        //         var $activeText = $('ul#discount-type-selector li.active').text();
        //         if ($activeText === 'Percent(%)') {
        //             dispercent = (disVal / 100);
        //         } else if ($activeText === 'Flat($)'){
        //             disFlat = parseInt(disVal);
        //         } 
        //     });
        // });
        // shipping calculation
        // $('.shipping-input').keyup(()=>{
        //     var shipVal = $('.shipping-input').val();
        //     var activeType = $('li.active');
        //     activeType.each(function(){
        //         var $activeText = $('ul#shipping-type-selector li.active').text();
        //         if ($activeText === 'Percent(%)') {
        //             shippercent = (shipVal / 100);
        //         } else if ($activeText === 'Flat($)'){
        //             shipFlat = + parseInt(shipVal);
        //         } 
        //     });
        // });

        
            
            //console.log(taxpercent);
        
        
        // if (!$tax.val()) {
        //     console.log('no value');
        //     totalWithTax = mult;
        //     $(".total").text(totalWithTax);
        // } else if ($tax.val()) {
        //     var $taxDiv = $('.tax');
        //     console.log($taxDiv);
        // }
        //var totalWithTax = mult + tax;
        //$(".total").text(totalWithTax);
    }
});


















