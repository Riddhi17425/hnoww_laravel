$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    var table = $('#giftTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getGiftS,
            data: function(d) {
                d.status = $('#status').val();
                d.product_type = $('#product_type').val();
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'gift_for', name:"gift_for" },
            { data: 'to_celebrate', to_celebrate: 'to_celebrate' },
            { data: 'product_name', to_celebrate: 'product_name' },
            { data: 'product_price', name: 'product_price' },
            { data: 'short_description', name: 'short_description' },
            { data: 'list_page_img', name: 'list_page_img', searchable: false  },
            { data: 'status', name: 'status', orderable: false, searchable: false  },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Trigger table reload when dropdown changes
    $('#status').change(function () {
        table.draw();
    });
    $('#product_type').change(function () {
        table.draw();
    });

    $(document).on('click', '.delete-gift', function () {
        let id = $(this).data('id');
        let url = window.APP_URLS.deleteGift.replace('__ID__', id);

        if (!confirm("Are you sure you want to delete this Gift?")) return;

        $.ajax({
            url: url,
            type: 'POST',
            data: {
                _method: 'DELETE',
                _token: window.APP_URLS.csrfToken
            },
            success: function (response) {
                if (response.result) {
                    $("#message-pop-up")
                        .show()
                        .removeClass('alert-warning')
                        .addClass('alert-success');

                    $("#success-message").html(response.message);

                    setTimeout(() => {
                        $("#message-pop-up").hide();
                    }, 3000);

                    $('#giftTable').DataTable().ajax.reload(null, false);
                } else {
                    $("#message-pop-up")
                        .show()
                        .removeClass('alert-success')
                        .addClass('alert-warning');

                    $("#success-message").html(response.message);
                }
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                alert('Delete failed!');
            }
        });
    });


});

$(document).on('click', '.delete-detail-img', function () {
    let index = $(this).data('index');
    let productId = $(this).data('product-id');
    if (!confirm('Delete this image?')) return;
    $.ajax({
        url: sitePath + "/admin/products/delete-detail-image",
        type: "POST",
        data: {
            product_id: productId,
            index: index
        },
        success: function () {
            $('#detail-img-' + index).remove();
        }
    });
});

$(document).on('click', '#deleteAllDetailImgs', function () {
    if (!confirm('Delete ALL detail images?')) return;
    let productId = $(this).data('product-id');
    $.ajax({
        url: sitePath + "/admin/products/delete-all-detail-images",
        type: "POST",
        data: {
            product_id: productId
        },
        success: function () {
            location.reload();
        }
    });
});

function updateStatus(status, productId){
    $.ajax({
        url:  window.APP_URLS.updateStatus,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': window.APP_URLS.csrfToken
        },
        data: {
            id: productId,
            status: status
        },
        success: function (response) {
            if (response.success) {
                alert(response.message);
                $('#giftTable').DataTable().ajax.reload(null, false);
            } else {
                alert('Something went wrong');
            }
        },
        error: function () {
            alert('Server error');
        }
    });
}

$(document).on("keyup", "#product_name", function() {
    var name = $(this).val();
    // Convert to lowercase, replace spaces with dash, remove special chars
    var slug = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

    $('#product_url').val(slug);
});


let cropper;
let selectedFile;

$('#list_img').on('change', function (e) {
    let file = e.target.files[0];
    if (!file) return;
    activeInput = this;

    // Store original image type & extension & name
    originalImageType = file.type; // image/png, image/jpeg, image/webp
    originalImageName = file.name; // keep original name

    let reader = new FileReader();
    reader.onload = function (event) {
        $('#cropperImage').attr('src', event.target.result);
        $('#cropperModal').modal('show');

        if (cropper) {
            cropper.destroy();
        }

        cropper = new Cropper(document.getElementById('cropperImage'), {
            viewMode: 1,
            autoCropArea: 1,
            responsive: true,
            dragMode: 'move',
            background: false,
            movable: true,
            zoomable: true,
            scalable: false,
            minContainerWidth: 900,
            minContainerHeight: 500,
        });
    };
    reader.readAsDataURL(file);
});

$('#cropImageBtn').on('click', function () {
    if (!cropper) return;
    cropper.getCroppedCanvas({
        imageSmoothingEnabled: true,
        imageSmoothingQuality: 'high',
    }).toBlob(function (blob) {

        // Use original file name
        const file = new File(
            [blob],
            originalImageName,
            {
                type: originalImageType,
                lastModified: Date.now()
            }
        );

        const dataTransfer = new DataTransfer();
        dataTransfer.items.add(file);
        // Replace original input file
        activeInput.files = dataTransfer.files;

        $('#cropperModal').modal('hide');
        cropper.destroy();
        cropper = null;

    }, originalImageType, 1); // keep original type & max quality
});

$(document).on('click', '.delete-detail-img', function () {
    let index = $(this).data('index');
    let giftId = $(this).data('gift-id');
    
    if (!confirm('Delete this image?')) return;
    $.ajax({
        url: sitePath + "/admin/gift/delete-detail-image",
        type: "POST",
        data: {
            gift_id: giftId,
            index: index
        },
        success: function () {
            $('#detail-img-' + index).remove();
        }
    });
});

$(document).on('click', '#deleteAllDetailImgs', function () {
    if (!confirm('Delete ALL detail images?')) return;
    let giftId = $(this).data('gift-id');
    $.ajax({
        url: sitePath + "/admin/gift/delete-all-detail-images",
        type: "POST",
        data: {
            gift_id: giftId
        },
        success: function () {
            location.reload();
        }
    });
});