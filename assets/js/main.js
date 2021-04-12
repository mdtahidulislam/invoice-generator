// appear image file after page refresh
const fileinput = document.querySelector('#fileinput');
fileinput.addEventListener('change', function () {
    const reader = new FileReader();
    reader.addEventListener('load', () => {
        localStorage.setItem('getImg', reader.result);
        const getImgUrl = localStorage.getItem('getImg');
        if(getImgUrl){
            document.querySelector('.preview-img').setAttribute('src', getImgUrl);
        }
    });
    reader.readAsDataURL(this.files[0]);
});
document.addEventListener('DOMContentLoaded', () => {
    const getImgUrl = localStorage.getItem('getImg');
    if(getImgUrl){
        let invFileInput = document.querySelector('.inv-file-input')
        let preview = document.querySelector('#preview');
        let imgTag = document.querySelector('.preview-img')
        let closeImg = document.querySelector('.close-img')
        imgTag.setAttribute('src', getImgUrl);
        if (imgTag.src !== '') {
            invFileInput.classList.add('d-none');
            preview.classList.remove('d-none');
            closeImg.addEventListener('click', () => {
                invFileInput.classList.remove('d-none');
                preview.classList.add('d-none');
            });
        }
    }
});
$(document).ready(function(){
    // file name show
    $('.inv-file-input').on('change',  function(e){
        //show slected file name as label
        //let fileName = $(this).val().split('\\').pop();
        //$(this).siblings('.inv-file-label').addClass('selected').html(fileName);
        //show image preview
        // const imgFile = this.files[0];
        // if (imgFile) {
        //     let reader = new FileReader();
        //     reader.onload = (e)=>{
        //         $('.preview-img').attr('src', e.target.result);
        //     }
        //     reader.readAsDataURL(imgFile);
        // }

        $('.inv-file-input').addClass('d-none');
        $('.preview').removeClass('d-none');

        // // close image preview
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
                //taxInput.setAttribute('placeholder', 0);
                //taxInput.setAttribute('dir', 'rtl');
                taxTypePercent.innerHTML = '%';
                taxTypeDollar.classList.add('d-none');
            } else if(selectedtype === 'Flat($)') {
                taxTypePercent.innerHTML = '';
                //taxInput.setAttribute('placeholder', '0');
                //taxInput.removeAttribute('dir');
                taxTypeDollar.classList.remove('d-none');
                let taxpercent = document.querySelector('#tax');
                taxpercent.parentElement.removeChild(taxpercent);
                $('.tax').prepend(`
                <input type="number" name="taxflat" id="tax" dir="rtl" placeholder="0" autocomplete="off" class="tax-input form-control">
                `);
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
                //discountInput.setAttribute('placeholder', 0);
                //discountInput.setAttribute('dir', 'rtl');
                discountTypePercent.innerHTML = '%';
                discountTypeDollar.classList.add('d-none');
            } else if(selectedtype === 'Flat($)') {
                discountTypePercent.innerHTML = '';
                //discountInput.setAttribute('placeholder', '0');
                //discountInput.removeAttribute('dir');
                discountTypeDollar.classList.remove('d-none');
                let discountpercent = document.querySelector('#discount');
                discountpercent.parentElement.removeChild(discountpercent);
                $('.discount').prepend(`
                <input type="number" name="discountflat" id="discount" dir="rtl" placeholder="0" autocomplete="off" class="discount-input form-control">
                `);
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
    let shippingType = shippingTypeDiv.querySelectorAll('.dropdown-item');
    shippingType.forEach(shippingTypeselector => {
        shippingTypeselector.addEventListener('click', function(){
            let selectedtype = this.innerHTML;
            let shippingInput = document.querySelector('#shipping-input');
            let shippingTypePercent = document.querySelector('.shipping-type-prcent');
            let shippingTypeDollar = document.querySelector('.shipping-type-dollar');
            if (selectedtype === 'Percent(%)') {
                //shippingInput.setAttribute('placeholder', 0);
                //shippingInput.setAttribute('dir', 'rtl');
                shippingTypePercent.innerHTML = '%';
                shippingTypeDollar.classList.add('d-none');
            } else if(selectedtype === 'Flat($)') {
                shippingTypePercent.innerHTML = '';
                //shippingInput.setAttribute('placeholder', '0');
                //shippingInput.removeAttribute('dir');
                shippingTypeDollar.classList.remove('d-none');
                let shippingpercent = document.querySelector('#shipping');
                shippingpercent.parentElement.removeChild(shippingpercent);
                $('.shipping').prepend(`
                <input type="number" name="shippingflat" id="shipping" dir="rtl" placeholder="0" autocomplete="off" class="shipping-input form-control">
                `);
            }
        });
    });

    // $('.sendbtn').click(function(e){
    //     e.preventDefault();
    //     let fromto = $('#fromto').val();
    //     let billto = $('#billto').val();
    //     let shipto = $('#shipto').val();
    //     let date = $('#date-datepicker').val();
    //     let payterms = $('#payterms').val();
    //     let duedate = $('#due-datepicker').val();
    //     let item = [];
    //     let qty = [];
    //     let rate = [];
    //     $('.item').each(function(){
    //         item.push($(this).val());
    //     });
    //     $('.qty').each(function(){
    //         qty.push($(this).val());
    //     });
    //     $('.rate').each(function(){
    //         rate.push($(this).val());
    //     });
    //     let notes = $('#notes').val();
    //     let terms = $('#terms').val();
    //     let tax = $('#tax').val();
    //     let discount = $('#discount').val();
    //     let shipping = $('#shipping').val();
    //     let paidamount = $('#paidamount').val();
    //     $.ajax({
    //         url: 'ajaxdata.php',
    //         method: 'POST',
    //         data: {
    //             fromto:fromto, 
    //             billto:billto, 
    //             shipto:shipto, 
    //             date:date, 
    //             payterms:payterms, 
    //             duedate:duedate, 
    //             item:item, 
    //             qty:qty, 
    //             rate:rate, 
    //             notes:notes,
    //             terms:terms,
    //             tax:tax,
    //             discount:discount,
    //             shipping:shipping,
    //             paidamount:paidamount
    //         },
    //         success: function(data){
    //             alert(data);
    //         }
    //     });
    // });
});

    

    
