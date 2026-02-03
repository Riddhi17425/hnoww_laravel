//Increase & Decrease Quantity with stock check
$(document).on('click', '.inc_btn', function () {
    // let parent = $(this).closest('.increment_decrement');
    // let qty = parseInt(parent.find('.qty_input').val());
    // let stock = parseInt(parent.data('stock'));
    // if(qty < stock){
    //     qty++;
    //     parent.find('.qty_input').val(qty);
    //     parent.find('.span_value').text(qty);
    // } else {
    //     parent.find('.qty_input').val(qty);
    //     parent.find('.span_value').text(qty);
    //     Swal.fire({
    //         icon: 'warning',
    //         title: 'Out of Stock',
    //         text: 'You cannot add more than available stock (' + stock + ')',
    //         timer: 3000,
    //         showConfirmButton: true,
    //         confirmButtonColor: '#B58A46',
    //     });
    // }
    let row = $(this).closest('.increment_decrement');
    let qtyInput = row.find('.qty_input');
    let qty = parseInt(qtyInput.val());
    let stock = parseInt($(this).closest('.increment_decrement').data('stock'));

 console.log("QTY - " + qty);
 console.log("STOCK - " + stock);
    if (qty < stock) {
        qty++;
        qtyInput.val(qty);
        row.find('.span_value').text(qty);
        recalculateCartTotals();
        updateCartCount();
    } else {
        // Keep quantity as-is
        qtyInput.val(qty);
        row.find('.span_value').text(qty);
        // Stock warning
        Swal.fire({
            icon: 'warning',
            title: 'Out of Stock',
            text: 'You cannot add more than available stock (' + stock + ')',
            timer: 3000,
            showConfirmButton: true,
            confirmButtonColor: '#B58A46',
        });
    }
    
});

$(document).on('click', '.dec_btn', function () {
    // let parent = $(this).closest('.increment_decrement');
    // let qty = parseInt(parent.find('.qty_input').val());
    // if(qty > 1){
    //     qty--;
    //     parent.find('.qty_input').val(qty);
    //     parent.find('.span_value').text(qty);
    // }
    let row = $(this).closest('.cart-item-row');
    let qtyInput = row.find('.qty_input');
    let qty = parseInt(qtyInput.val());
    if (qty > 1) {
        qty--;
        qtyInput.val(qty);
        row.find('.span_value').text(qty);
        recalculateCartTotals();
        updateCartCount();
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
                        //location.reload();
                        let currentCount = parseInt($('#cart-count').text()) || 0;
                        let addedQty = parseInt($('#product-qty').val()) || 1;
                        $('#cart-count').text(currentCount + addedQty);
                        $('#cart-count').show();
                    }
                });
            } else {
                var message = response.message;
                var availableQty = response.data.available_stock;
                var alreadyAddedQty = response.data.already_in_cart;
                if(availableQty > 0){
                    message += " Total Stock Quantity is "+availableQty;
                }
                if(alreadyAddedQty > 0){
                    message += " Your cart has already "+alreadyAddedQty+" QTY added";
                }
                // $('.span_value').text(1);
                // $('.qty_input').text(1);
                Swal.fire({
                    icon: 'warning',
                    title: 'Warning',
                    text: message,
                    //timer: 3000,
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

$(document).on('click', '.delete-cart-item', function () {
    let cartId = $(this).data('id');
    Swal.fire({
        icon: 'warning',
        title: 'Remove this item from cart?',
        text: 'This item will be removed from your cart.',
        showCancelButton: true,          // 👈 IMPORTANT
        confirmButtonText: 'Yes, remove',
        cancelButtonText: 'No, keep it',
        confirmButtonColor: '#B58A46',
        cancelButtonColor: '#6c757d'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: sitePath + '/cart/delete',
                type: "POST",
                data: {
                    cart_id: cartId
                },
                success: function (response) {
                    if (response.status) {
                        $('#cart-row-' + cartId).remove();
                        recalculateCartTotals();
                        updateCartCount();
                        // Check if this was the last cart item
                        if ($('#cart_item_list .cart-item-row').length === 0) {
                            let emptyRow = `
                                <tr class="empty-cart-row">
                                    <td class="text-center" colspan="6">
                                        There are no any carts available.
                                        <a href="{{ route('front.home') }}" class="com_btn">
                                            Continue shopping
                                        </a>
                                    </td>
                                </tr>
                            `;
                            $('#cart_item_list').append(emptyRow);
                            $('#calculation-section').remove();
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                        });
                    }
                }
            });
        }
    });
    
});

function recalculateCartTotals() {
    let subtotal = 0;

    $('.cart-item-row').each(function () {
        let qty = parseInt($(this).find('.qty_input').val());
        let price = parseFloat($(this).find('.unit-price').data('price'));

        let rowTotal = qty * price;
        $(this).find('.row-total').text(rowTotal.toFixed(2));

        subtotal += rowTotal;
    });

    $('#cart-subtotal').text(subtotal.toFixed(2) + ' AED');
    $('#you-pay').text(subtotal.toFixed(2) + ' AED');
}

// Update cart total for Header cart Icon
function updateCartCount() {
    let totalQty = 0;
    $('.cart-item-row').each(function () {
        let qty = parseInt($(this).find('.qty_input').val()) || 0;
        totalQty += qty;
    });
    $('#cart-count').text(totalQty);
    // Hide badge if cart empty (optional)
    if (totalQty === 0) {
        $('#cart-count').hide();
    } else {
        $('#cart-count').show();
    }
}
