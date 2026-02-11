$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
   $('select[name="category_type"]').on('change', function () {
        let selectedType = $(this).val();
        let $categorySelect = $('#category_id'); // make sure this matches your select's id

        // Clear existing options
        $categorySelect.empty();

        // Add default "Select Category"
        $categorySelect.append('<option value="">Select Category</option>');

        let categories = [];
        if (selectedType == '1') {
            categories = normalCategories;
        } else if (selectedType == '2') {
            categories = corporateCategories;
        } else if (selectedType == '3') {
            categories = weddingCategories;
        }

        console.log("categories - " + JSON.stringify(categories));

        // Append new categories
        $.each(categories, function (index, category) {
            $categorySelect.append(`<option value="${category.id}">${category.category_name}</option>`);
        });

        // ✅ Only set existingCat if it exists
        let existingCat = $('#existing_cat_id').val();
        if (existingCat) {
            $categorySelect.val(existingCat);
        } 
        // On add page, do NOT set val('') here. Let default "Select Category" stay selected
    });

    // 🔥 Trigger change AFTER DOM is ready
    $(document).ready(function() {
        $('select[name="category_type"]').trigger('change');
    });

    var table = $('#productTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getProducts,
            data: function(d) {
                d.status = $('#status').val(); // send dropdown value
                d.product_type = $('#product_type').val();
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'category_name', name:"category_name" },
            { data: 'product_name', product_name: 'name' },
            { data: 'product_price', name: 'product_price' },
            { data: 'short_description', name: 'short_description' },
            { data: 'product_type', name: 'product_type', searchable: false  },
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

    $(document).on('click', '.delete-product', function () {
        let id = $(this).data('id');
        var url = window.APP_URLS.deleteProduct.replace(':id' , id);
        if (confirm("Are you sure you want to delete this Product?")) {
            $.ajax({
                url: url,  // Make sure your route matches this
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window.APP_URLS.csrfToken
                },
                success: function (response) {
                    if(response.result){
                        $("#message-pop-up").attr('style' , 'display:block')
                        $("#message-pop-up").addClass('alert-success')
                        $("#success-message").html(response.message);
                        setTimeout(() => {
                            $("#message-pop-up").attr('style' , 'display:none')
                        }, 3000);
                        table.draw();
                    }else{
                        $("#message-pop-up").attr('style' , 'display:block')
                        $("#message-pop-up").addClass('alert-warning')
                        $("#success-message").html(response.message);
                        setTimeout(() => {
                            $("#message-pop-up").attr('style' , 'display:none')
                        }, 3000);
                    }
                },
                error: function (xhr) {
                    alert('Something went wrong!');
                }
            });
        }
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
                // reload datatable if needed
                $('#productTable').DataTable().ajax.reload(null, false);
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

 
// ------------ PRODUCT TAB START ----------------

$(document).ready(function() {
    function initSummernote(element) {
        element.summernote({
            placeholder: 'Enter Product TAB...',
            height: 200,
            toolbar: [
                ['style', ['bold', 'italic', 'underline']],
                ['para', ['ul', 'ol']],
                ['insert', ['link']],
                ['view', ['codeview']]
            ]
        });
    }

    // Initialize first textarea
    initSummernote($('.tab-details'));

    // Add More TAB
    $('#addTab').click(function () {
        let tabHtml = `
        <div class="row tab-item mt-3">
            <div class="col-md-3 mb-3">
                <label class="form-label">Title <span class="required-star">*</span></label>
                <input type="text" name="title[]" class="form-control" placeholder="Enter Tab Title">
            </div>
            <div class="col-md-8 mb-3">
                <textarea name="details[]" class="form-control tab-details" placeholder="Enter Tab Details"></textarea>
            </div>
            <div class="col-md-1 mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeTab">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>`;
        $('#tabWrapper').append(tabHtml);
    });

    // Remove TAB
    $(document).on('click', '.removeTab', function () {
        //if ($('.tab-item').length > 1) {
            $(this).closest('.tab-item').remove();
        // } else {
        //     alert('At least one Tab is required.');
        // }
    });

    // LIST PAGE
    var table = $('#product_tabs_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: window.APP_URLS.getProductTabs,
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'product_name', name: 'product_name' },
            { data: 'total_tabs', name: 'total_tabs', orderable: false },
            { data: 'action', orderable: false, searchable: false }
        ]
    });

    // DELETE TABs
    $(document).on('click', '.delete-product-tabs', function () {

        let id = $(this).data('id');
        let url = window.APP_URLS.deleteProductTabs.replace(':id', id);

        if (confirm('Are you sure you want to delete all TABs for this product?')) {

            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': window.APP_URLS.csrfToken
                },
                success: function (response) {

                    $("#message-pop-up").show()
                        .removeClass('alert-success alert-warning')
                        .addClass(response.result ? 'alert-success' : 'alert-warning');

                    $("#success-message").html(response.message);

                    setTimeout(() => {
                        $("#message-pop-up").hide();
                    }, 3000);

                    if (response.result) {
                        table.draw();
                    }
                },
                error: function () {
                    alert('Something went wrong!');
                }
            });
        }
    });

    // LIST PAGE
    // var imgTable = $('#product_images_table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: window.APP_URLS.getProductImages,
    //     order: [[0, 'desc']],
    //     columns: [
    //         { data: 'id', name: 'id' },
    //         { data: 'product_name', name: 'product_name' },
    //         { data: 'total_images', name: 'total_images', orderable: false },
    //         { data: 'action', orderable: false, searchable: false }
    //     ]
    // });
});

// PRODUCT IMAGES
// let cropper;
// let activeInput = null;
// let originalImageType = 'image/jpeg';
// let originalImageExt = 'jpg';

// window.addEventListener('load', function () {

//     // ADD MORE IMAGE
//     $('#addImg').click(function () {
//         let imageHtml = `
//         <div class="row img-item mt-3">
//             <div class="col-md-6 mb-3">
//                 <label class="form-label">Image <span class="required-star">*</span></label>
//                 <input type="file" name="image[]" class="form-control image-input" accept="image/*">
//             </div>
//             <div class="col-md-1 mb-3 d-flex align-items-end">
//                 <button type="button" class="btn btn-danger removeImage">
//                     <i class="bi bi-trash"></i>
//                 </button>
//             </div>
//         </div>`;
//         $('#imageWrapper').append(imageHtml);
//     });

//     // REMOVE IMAGE
//     $(document).on('click', '.removeImage', function () {
//         if ($('.img-item').length > 1) {
//             $(this).closest('.img-item').remove();
//         } else {
//             alert('At least one Image is required.');
//         }
//     });

//     // OPEN CROPPER ON IMAGE SELECT
//     $(document).on('change', '.image-input', function (e) {
//         let file = e.target.files[0];
//         if (!file) return;

//         activeInput = this;

//         // ✅ STORE ORIGINAL IMAGE TYPE & EXTENSION
//         originalImageType = file.type; // image/png, image/jpeg, image/webp
//         originalImageExt = file.name.split('.').pop().toLowerCase();

//         let reader = new FileReader();
//         reader.onload = function (event) {
//         $('#cropperImage').attr('src', event.target.result);
//         $('#cropperModal').modal('show');

//         if (cropper) {
//             cropper.destroy();
//         }

//         cropper = new Cropper(document.getElementById('cropperImage'), {
//                 viewMode: 1,
//                 autoCropArea: 1,
//                 responsive: true,
//                 dragMode: 'move',
//                 background: false,
//                 movable: true,
//                 zoomable: true,
//                 scalable: false,
//                 minContainerWidth: 900,
//                 minContainerHeight: 500,
//             });
//         };
//         reader.readAsDataURL(file);
//     });

//     // CROP IMAGE (KEEP ORIGINAL FORMAT + HIGH QUALITY)
//     $('#cropImageBtn').click(function () {
//         if (!cropper) return;

//         cropper.getCroppedCanvas({
//             imageSmoothingEnabled: true,
//             imageSmoothingQuality: 'high',
//         }).toBlob(function (blob) {

//             const file = new File(
//                 [blob],
//                 `product_${Date.now()}.${originalImageExt}`,
//                 {
//                     type: originalImageType,
//                     lastModified: Date.now()
//                 }
//             );

//             const dataTransfer = new DataTransfer();
//             dataTransfer.items.add(file);

//             // Replace original input file
//             activeInput.files = dataTransfer.files;

//             $('#cropperModal').modal('hide');
//             cropper.destroy();
//             cropper = null;

//         }, originalImageType, 1); // 👈 keep original type & max quality
//     });

//     $(document).ready(function () {
//         $('#prodcutImageForm').validate({
//             ignore: [],
//             rules: {
//                 product: {
//                     required: true
//                 },
//                 'image[]': {
//                     required: true,
//                     extension: "jpg|jpeg|png|webp",
//                     filesize5: 5242880 // 5MB
//                 }
//             },
//             messages: {
//                 product: {
//                     required: "Please select a product."
//                 },
//                 'image[]': {
//                     required: "Please upload at least one product image.",
//                     extension: "Only JPG, JPEG, PNG or WEBP images are allowed."
//                 }
//             },
//             errorElement: 'div',
//             errorClass: 'invalid-feedback',
//             highlight: function (element) {
//                 $(element).addClass('is-invalid');
//             },
//             unhighlight: function (element) {
//                 $(element).removeClass('is-invalid');
//             },
//             errorPlacement: function (error, element) {
//                 if (element.attr("type") === "file") {
//                     error.insertAfter(element);
//                 } else {
//                     error.insertAfter(element);
//                 }
//             }
//         });

//         $(document).on('change', '.image-input', function () {
//             $(this).valid();
//         });
//     });

//     // DELETE Imgs
//     $(document).on('click', '.delete-product-imgs', function () {

//         let id = $(this).data('id');
//         let url = window.APP_URLS.deleteProductImages.replace(':id', id);

//         if (confirm('Are you sure you want to delete all Images for this product?')) {

//             $.ajax({
//                 url: url,
//                 type: 'DELETE',
//                 headers: {
//                     'X-CSRF-TOKEN': window.APP_URLS.csrfToken
//                 },
//                 success: function (response) {

//                     $("#message-pop-up").show()
//                         .removeClass('alert-success alert-warning')
//                         .addClass(response.result ? 'alert-success' : 'alert-warning');

//                     $("#success-message").html(response.message);

//                     setTimeout(() => {
//                         $("#message-pop-up").hide();
//                     }, 3000);

//                     if (response.result) {
//                         imgTable.draw();
//                     }
//                 },
//                 error: function () {
//                     alert('Something went wrong!');
//                 }
//             });
//         }
//     });

// });
