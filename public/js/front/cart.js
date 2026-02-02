//Increase & Decrease Quantity with stock check
$(document).on('click', '.inc_btn', function () {
    let parent = $(this).closest('.increment_decrement');
    let qty = parseInt(parent.find('.qty_input').val());
    let stock = parseInt(parent.data('stock'));

    if(qty < stock){
        qty++;
        parent.find('.qty_input').val(qty);
        parent.find('.span_value').text(qty);
    } else {
        parent.find('.qty_input').val(qty);
        parent.find('.span_value').text(qty);
        Swal.fire({
            icon: 'warning',
            title: 'Out of Stock',
            text: 'You cannot add more than available stock (' + stock + ')',
            timer: 3000,
            showConfirmButton: true,
            confirmButtonColor: '#B58A46',
            customClass: {
               // confirmButton: 'com_btn' // add a custom class if you want
            }
        });
    }
});

$(document).on('click', '.dec_btn', function () {
    let parent = $(this).closest('.increment_decrement');
    let qty = parseInt(parent.find('.qty_input').val());

    if(qty > 1){
        qty--;
        parent.find('.qty_input').val(qty);
        parent.find('.span_value').text(qty);
    }
});


$(document).on('click', '.add_to_cart_btn', function () {
    let productId = $(this).data('product-id');
    let qty = $(this).closest('.increment_decrement_area').find('.qty_input').val();
    $.ajax({
        url: sitePath + '/cart/add',
        method: "POST",
        data: {
            product_id: productId,
            quantity: qty
        },
        success: function (response) {
            if(response.status){
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message,
                    //timer: 3000,
                    showConfirmButton: true,
                    confirmButtonColor: '#B58A46',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reload the page when OK button is clicked
                        location.reload();
                    }
                });
            } else {
                var message = response.message;
                var availableQty = response.data;
                if(availableQty > 0){
                    availableQty = response.data;
                    message += " You can add upto "+availableQty;
                }
                // $('.span_value').text(1);
                // $('.qty_input').text(1);
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: message,
                    timer: 3000,
                    showConfirmButton: true,
                    confirmButtonColor: '#B58A46',
                });
            }
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong!',
            });
        }
    });
});
