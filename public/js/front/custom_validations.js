$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Custom method to block name 'RobertAppex'
$.validator.addMethod("blockName", function(value, element) {
    return this.optional(element) || value.toLowerCase() !== "robertappex";
}, "This name is not allowed.");

// Custom method to allow English (ASCII) characters only
$.validator.addMethod("englishOnly", function(value, element) {
    return this.optional(element) || /^[\x00-\x7F]*$/.test(value);
}, "Only English characters are allowed.");

// Custom method for valid phone number (basic example)
$.validator.addMethod("validPhone", function(value, element) {
    return this.optional(element) || /^[0-9]{7,15}$/.test(value);
}, "Please enter a valid phone number (7-15 digits).");

$.validator.addMethod("lettersonly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z\s]+$/.test(value);
}, "Letters only please");

$.validator.addMethod("noSpamEmail", function (value, element) {
    const spamPatterns = [
        /^[a-zA-Z]{8,}[0-9]{6,}@/,
        /^[0-9]+@/,
        /(temp-mail|10minutemail|mailinator|guerrillamail|yopmail|throwawaymail|form-check.online|seismologiomail|ru|mailport.lat)/i,
        /^(test|demo|example|noreply|fake|admin|info|random|dummy)/i,
        /^(.)(\1){5,}@/
    ];

    for (let pattern of spamPatterns) {
        if (pattern.test(value)) {
            return false;
        }
    }
    return true;
}, "This email is not allowed");

// $.validator.addMethod("uniqueEmail", function (value, element) {
//     let isValid = false;
//     $.ajax({
//         url: sitePath + "/check-email-unique",
//         type: "POST",
//         headers: {
//             'X-CSRF-TOKEN': csrfToken
//         },
//         data: { email: value },
//         async: false,
//         success: function (response) {
//             isValid = response.unique === true;
//         }
//     });

//     return isValid;
// }, "This email is already registered");

// tableName is a string identifying which table to check
$.validator.addMethod("uniqueEmail", function(value, element, tableName) {
    let isValid = false;

    $.ajax({
        url: sitePath + "/check-email-unique",
        type: "POST",
        data: { 
            email: value,
            table: tableName // send table name to backend
        },
        async: false,
        success: function(response) {
            isValid = response.unique === true;
        }
    });
    return isValid;
}, "This email is already registered");

$.validator.addMethod('filesize5', function (value, element, param) {
    if (element.files.length === 0) return true;
    return element.files[0].size <= param;
}, 'File size must be less than 5MB.');

 // Custom validation rule for date after today
$.validator.addMethod("minDate", function(value, element) {
    var selectedDate = new Date(value);
    var today = new Date();
    today.setHours(0,0,0,0); // remove time part
    return this.optional(element) || selectedDate > today;
});