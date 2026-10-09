//Increase & Decrease Quantity with stock check
function showStockLimitMessage() {
    Swal.fire({
        icon: 'warning',
        title: 'Stock limit reached',
        text: 'You cannot add more quantity.',
        showConfirmButton: true,
        confirmButtonColor: '#B58A46',
    });
}

function saveCartQuantity(row, productId, cartId, quantity, previousQuantity) {
    $.post(sitePath + '/cart/add', {
        cart_id: cartId,
        quantity: quantity,
        product_id: productId
    }).done(function (response) {
        if (!response.status) {
            row.find('.qty_input').val(previousQuantity);
            row.find('.span_value').text(previousQuantity);
            recalculateCartTotals();
            updateCartCount();
            Swal.fire({
                icon: 'warning',
                title: 'Stock limit reached',
                text: response.message || 'The requested quantity is not available.',
                showConfirmButton: true,
                confirmButtonColor: '#B58A46',
            });
        }
    }).fail(function () {
        row.find('.qty_input').val(previousQuantity);
        row.find('.span_value').text(previousQuantity);
        recalculateCartTotals();
        updateCartCount();
        Swal.fire({ icon: 'error', title: 'Error', text: 'Could not update the cart quantity.' });
    });
}

$(document).on('click', '.inc_btn', function () {
    let row = $(this).closest('.increment_decrement');
    let qtyInput = row.find('.qty_input');
    let qty = parseInt(qtyInput.val());
    let stock = parseInt($(this).closest('.increment_decrement').data('stock'));
    let cartId = row.data('cart-id');
    let productId = row.data('product-id');
    let callFrom = $(this).data('call');
    if (qty < stock) {
        let previousQty = qty;
        qty++;
        qtyInput.val(qty);
        row.find('.span_value').text(qty);
        if(callFrom == 'cart'){
            recalculateCartTotals();
            updateCartCount();
            saveCartQuantity(row, productId, cartId, qty, previousQty);
        }
    } else {
        // Keep quantity as-is
        qtyInput.val(qty);
        row.find('.span_value').text(qty);
        // Stock warning
        showStockLimitMessage();
    }
});

$(document).on('click', '.dec_btn', function () {
    let row = $(this).closest('.increment_decrement');
    let qtyInput = row.find('.qty_input');
    let qty = parseInt(qtyInput.val());
    let cartId = row.data('cart-id');
    let productId = row.data('product-id');
    let callFrom = $(this).data('call');
    if (qty > 1) {
        let previousQty = qty;
        qty--;
        qtyInput.val(qty);
        row.find('.span_value').text(qty);
        if(callFrom == 'cart'){
            recalculateCartTotals();
            updateCartCount();
            saveCartQuantity(row, productId, cartId, qty, previousQty);
        }
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
                        // let currentCount = parseInt($('#cart-count').text()) || 0;
                        // let addedQty = parseInt($('#product-qty').val()) || 1;
                        // $('#cart-count').text(currentCount + addedQty);
                        let newCount = response.cart_count || 0;
                        $('.cart-total').text(newCount).show();
                        $('#cart-count').show();
                    }
                });
            } else {
                var message = response.message;
                var data = response.data || {};
                Swal.fire({
                    icon: 'warning',
                    title: 'Stock limit reached',
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
                            let emptyRow = `<div class="text-center">
                                    <img class="img-fluid" style="" src="${window.appData.emptyCartImage}" alt="about us banner">
                                    <h5 class="sub_head my-3">Your shopping bag is currently empty.</h5>
                                    <a href="${window.appData.homeUrl}"
                                    class="com_btn mt-2">Continue shopping</a>
                                </div>
                            `;
                            $('#cartTable').hide();
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

    // $discount = (subtotal * discountPercent) / 100; // Calculate discount based on global value
    // $discountedTotal = subtotal - $discount; // Calculate total after discount    
    // $('#discounted-values').text(`- AED ${$discount.toFixed(2)}`); // Display discount  
    
    $('#cart-subtotal').text(subtotal.toFixed(2) + ' AED');
    $('#you-pay').text(subtotal.toFixed(2) + ' AED');
    // $('#you-pay').text(`AED ${$discountedTotal.toFixed(2)}`); // Display total after discount
}

// Update cart total for Header cart Icon
function updateCartCount() {
    let totalQty = 0;
    $('.cart-item-row').each(function () {
        let qty = parseInt($(this).find('.qty_input').val()) || 0;
        totalQty += qty;
    });
    //$('#cart-count').text(totalQty);
    $('.cart-total').text(totalQty);
    // Hide badge if cart empty (optional)
    if (totalQty === 0) {
        // $('#cart-count').hide();
        $('.cart-total').hide();
    } else {
        // $('#cart-count').show();
        $('.cart-total').show();
    }
}
