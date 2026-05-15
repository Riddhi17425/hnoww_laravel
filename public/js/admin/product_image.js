$(function() {
    let cropper;
    let activeInput = null;

    // ADD MORE IMAGE
    $('#addImg').click(function () {
        let imageHtml = `<div class="row img-item mt-3">
            <div class="col-md-6 mb-3">
                <label class="form-label">Image <span class="required-star">*</span></label>
                <input type="file" name="image[]" class="form-control image-input" accept="image/*">
            </div>
            <div class="col-md-1 mb-3 d-flex align-items-end">
                <button type="button" class="btn btn-danger removeImage">
                    <i class="bi bi-trash"></i>
                </button>
            </div>
        </div>`;
        $('#imageWrapper').append(imageHtml);
    });

    // REMOVE IMAGE
    $(document).on('click', '.removeImage', function () {
        if ($('.img-item').length > 1) {
            $(this).closest('.img-item').remove();
        } else {
            alert('At least one Image is required.');
        }
    });

    // OPEN CROPPER ON IMAGE SELECT
    $(document).on('change', '.image-input', function (e) {
        let file = e.target.files[0];
        if (!file) return;

        activeInput = this;
        let reader = new FileReader();
        reader.onload = function (event) {
            $('#cropperImage').attr('src', event.target.result);
            $('#cropperModal').modal('show');

            if (cropper) cropper.destroy();

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

    // CROP IMAGE
    $('#cropImageBtn').click(function () {
        if (!cropper) return;
        cropper.getCroppedCanvas({ imageSmoothingEnabled: true, imageSmoothingQuality: 'high' })
            .toBlob(function(blob) {
                const file = new File([blob], `product_${Date.now()}.jpg`, { type: 'image/jpeg', lastModified: Date.now() });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                activeInput.files = dataTransfer.files;

                $('#cropperModal').modal('hide');
                cropper.destroy();
                cropper = null;

                // Refresh jQuery Validate after changing file input
                $('#prodcutImageForm').validate().element($(activeInput));
            }, 'image/jpeg', 1);
    });

    // JQUERY VALIDATION
    $('#prodcutImageForm').validate({
        rules: {
            product: { required: true },
            'image[]': {
                required: function() {
                    // Check if there is at least one file input with a file OR at least one existing image
                    let hasFile = false;
                    $('.image-input').each(function() {
                        if ($(this).val()) hasFile = true;
                    });
                    let hasExisting = $('.existing-image').length > 0;
                    return !(hasFile || hasExisting);
                },
                extension: "jpg|jpeg|png|webp" // will only validate non-empty fields
            }
        },
        messages: {
            product: { required: "Please select a product." },
            'image[]': {
                required: "Please upload at least one image.",
                extension: "Only JPG, JPEG, PNG, or WEBP allowed."
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        highlight: function(element) { $(element).addClass('is-invalid'); },
        unhighlight: function(element) { $(element).removeClass('is-invalid'); },
        errorPlacement: function(error, element) { error.insertAfter(element); }
    });

    // Fix for case-insensitive extension validation
    $.validator.addMethod("extension", function(value, element, param) {
        if (!value) return true; // <-- ignore empty fields
        param = typeof param === "string" ? param.replace(/,/g, '|') : "png|jpe?g|webp";
        return value.match(new RegExp(".(" + param + ")$", "i"));
    }, "Please enter a valid file type.");


    $(document).on('click', '.removeExistingImage', function() {
        $(this).closest('.existing-image').remove();
    });

});
