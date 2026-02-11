var element = $('#product_of_interest')[0];  // get raw DOM element from jQuery object
var choices = new Choices(element, {
    removeItemButton: true,  // shows an "x" to deselect each selected option
    placeholder: true,
    placeholderValue: 'Select products',
    searchEnabled: true,
});

var element = $('#w_product_of_interest')[0];  // get raw DOM element from jQuery object
var choices = new Choices(element, {
    removeItemButton: true,  // shows an "x" to deselect each selected option
    placeholder: true,
    placeholderValue: 'Select products',
    searchEnabled: true,
});

var element = $('#k_product_of_interest')[0];  // get raw DOM element from jQuery object
var choices = new Choices(element, {
    removeItemButton: true,  // shows an "x" to deselect each selected option
    placeholder: true,
    placeholderValue: 'Select products',
    searchEnabled: true,
});


var cFormSubmitted = false;
$("#requestCorporateProposalForm").validate({
    ignore: [],
    rules: { 
        full_name: { 
            required: true, 
            minlength: 2, 
            maxlength: 50, 
            lettersonly: true 
        },
        company_name: { 
            required: true 
        },
        phone: { 
            required: true, 
            number: true, 
            validPhone: true 
        },
        email: { 
            required: true, 
            email: true, 
            noSpamEmail: true, 
            uniqueEmail: "corporate_proposal_requests" 
        },
        'product_of_interest[]': { 
            required: true 
        },
        quantity_range: { 
            required: true 
        },
        delivery_date: { 
            required: true, 
            date: true, 
            minDate: true 
        },
        message:{
            maxlength:500,
        }
    },
    messages: {
        full_name: {
            required: "Please enter your full name",
            minlength: "Full name must be at least 2 characters",
            maxlength: "Full name cannot exceed 50 characters",
            lettersonly: "Full name can only contain letters and spaces"
        },
        company_name: {
            required: "Please enter your company or organization name"
        },
        phone: {
            required: "Please enter your phone number",
            number: "Phone number must contain only digits",
            validPhone: "Enter a valid phone number"
        },
        email: {
            required: "Please enter your email address",
            email: "Please enter a valid email address",
            noSpamEmail: "This email address is not allowed",
            uniqueEmail: "This email is already used"
        },
        'product_of_interest[]': {
            required: "Please select at least one product of interest"
        },
        quantity_range: {
            required: "Please select a quantity range"
        },
        delivery_date: {
            required: "Please select a delivery date",
            date: "Enter a valid date",
            minDate: "Delivery date must be after today"
        },
        message:{
            maxlength: "Message cannot exceed 50 characters",
        }
    },
    errorElement: 'div',
    errorPlacement: function(error, element) {
        if (element.attr('name') === 'product_of_interest[]') {
            $('#product_error').append(error);
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight: function(element) {
        $(element).addClass('is-valid').removeClass('is-invalid');
    },
    submitHandler: function(form) {
        if (!cFormSubmitted) {
            cFormSubmitted = true;
            const btn = $(form).find('button[type="submit"]');
            if (btn.length) {
                btn.prop('disabled', true).text('Submitting...');
            }
            form.submit();
        }
    }
});

var wFormSubmitted = false;
$("#requestWeddingCatalogueForm").validate({
    ignore: [],
    rules: { 
        w_full_name: { 
            required: true, 
            minlength: 2, 
            maxlength: 50, 
            lettersonly: true 
        },
        w_company_name: { 
            required: true 
        },
        w_phone: { 
            required: true, 
            number: true, 
            validPhone: true 
        },
        w_email: { 
            required: true, 
            email: true, 
            noSpamEmail: true, 
            uniqueEmail: "corporate_proposal_requests" 
        },
        'w_product_of_interest[]': { 
            required: true 
        },
        w_quantity_range: { 
            required: true 
        },
        w_delivery_date: { 
            required: true, 
            date: true, 
            minDate: true 
        },
        w_message:{
            maxlength:500,
        }
    },
    messages: {
        w_full_name: {
            required: "Please enter your full name",
            minlength: "Full name must be at least 2 characters",
            maxlength: "Full name cannot exceed 50 characters",
            lettersonly: "Full name can only contain letters and spaces"
        },
        w_company_name: {
            required: "Please enter your company or organization name"
        },
        w_phone: {
            required: "Please enter your phone number",
            number: "Phone number must contain only digits",
            validPhone: "Enter a valid phone number"
        },
        w_email: {
            required: "Please enter your email address",
            email: "Please enter a valid email address",
            noSpamEmail: "This email address is not allowed",
            uniqueEmail: "This email is already used"
        },
        'w_product_of_interest[]': {
            required: "Please select at least one product of interest"
        },
        w_quantity_range: {
            required: "Please select a quantity range"
        },
        w_delivery_date: {
            required: "Please select a delivery date",
            date: "Enter a valid date",
            minDate: "Delivery date must be after today"
        },
        w_message:{
            maxlength: "Message cannot exceed 50 characters",
        }
    },
    errorElement: 'div',
    errorPlacement: function(error, element) {
        if (element.attr('name') === 'w_product_of_interest[]') {
            $('#w_product_error').append(error);
        } else {
            error.insertAfter(element);
        }
    },
    highlight: function(element) {
        $(element).addClass('is-invalid').removeClass('is-valid');
    },
    unhighlight: function(element) {
        $(element).addClass('is-valid').removeClass('is-invalid');
    },
    submitHandler: function(form) {
        if (!wFormSubmitted) {
            wFormSubmitted = true;
            const btn = $(form).find('button[type="submit"]');
            if (btn.length) {
                btn.prop('disabled', true).text('Submitting...');
            }
            form.submit();
        }
    }
});

$( document ).ready(function() {
    $("#productInquiryForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 50,
                lettersonly: true
            },
            email: {
                required: true,
                email: true,
                noSpamEmail: true,
                //uniqueEmail: true
                uniqueEmail: function() {
                    if ($('form [name="inquiry_for"]').length) {
                        $formTable = $('form [name="inquiry_for"]').val() == 'gift' ? 'gift_shops' : 'product_inquiries';
                        return $formTable;
                    }
                }
            },
            product_id: {
                required: function () {
                    return $('[name="inquiry_for"]').val() === 'gift';
                }
            },
            contact_no: {
                required: true,
                validPhone: true,
                number:true,
                minlength:8,
                maxlength:15
            },
            message: {
                maxlength: 300
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 2 characters",
                maxlength: "Name cannot be longer than 50 characters",
                lettersonly: "Only letters and spaces are allowed"
            },
            product_id:{
                required: "Please select Product"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                noSpamEmail: "This email address is not allowed",
            },
            contact_no: {
                required: "Please enter your Contact number"
            },
            comment: {
                maxlength: "Message cannot be longer than 300 characters"
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            // error.addClass('invalid-feedback');
            // if (element.attr("name") === "g-recaptcha-response") {
            //     error.insertAfter(".g-recaptcha"); // show error below CAPTCHA
            // } else {
                error.insertAfter(element);
            //}
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function(form) {
            if (!formSubmitted) {
                formSubmitted = true;
                const btn = $(form).find('button[type="submit"]');
                if (btn.length) {
                    btn.prop('disabled', true).text('Submitting...');
                }
                form.submit();
            }
        }
    });

    $('#gift_for_filter, #to_celebrate_filter, #gift_price_filter').on('change', function () {
        let giftFor     = $('#gift_for_filter').val();
        let toCelebrate = $('#to_celebrate_filter').val();
        let priceFilter = $('#gift_price_filter').val();
        $.ajax({
            url: window.location.pathname,
            type: 'GET',
            data: {
                gift_for: giftFor,
                to_celebrate: toCelebrate,
                gift_price_range: priceFilter,
            },
            beforeSend: function () {
                $('#gift-list-wrapper').css('opacity', '0.5');
            },
            success: function (response) {
                // Update gift section
                $('#gift-list-wrapper').html(response);
                $('#gift-list-wrapper').css('opacity', '1');
                // Scroll ONLY after filter applied
                $('html, body').animate({
                    scrollTop: $('#gift-section').offset().top - 80
                }, 700);
            }
        });
    });



});