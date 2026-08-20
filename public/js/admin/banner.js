$(document).ready(function () {
    var table = $('#bannerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getBanners,
            data: function(d) {
                d.status = $('#status').val(); // send dropdown value
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'type', name: 'type' },
            { data: 'description', name: 'description' },
            { data: 'image', name: 'image', orderable: false, searchable: false },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Trigger table reload when dropdown changes
    $('#status').change(function () {
        table.draw();
    });

});

function updateStatus(status, catId){
    $.ajax({
        url:  window.APP_URLS.updateStatus,
        type: "POST",
        headers: {
            'X-CSRF-TOKEN': window.APP_URLS.csrfToken
        },
        data: {
            id: catId,
            status: status
        },
        success: function (response) {
            console.log(response);
            if (response.success) {
                alert(response.message);
            } else {
                alert(response.message);
            }
            $('#bannerTable').DataTable().ajax.reload(null, false);
        },
        error: function () {
            alert('Server error');
        }
    });
}

$(document).on('click', '.delete-banner', function () {
    let id = $(this).data('id');
    let url = window.APP_URLS.deleteBanner.replace('__ID__', id);

    if (!confirm("Are you sure you want to delete this Banner?")) return;

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

                $('#bannerTable').DataTable().ajax.reload(null, false);
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

// ---------------- SHOW/HIDE IMAGE OR VIDEO FIELDS BASED ON CATEGORY (TYPE) ----------------
$(document).ready(function() {
    var typeEl = $('#type')[0];

    if (typeEl) {
        // On page load: show fields only if a type is already selected (e.g. edit page)
        toggleBannerFields();
        $('#type').on('change', function () {
            toggleBannerFields();
            // remove any leftover invalid state when switching type
            $('#bannerForm .is-invalid').removeClass('is-invalid');
        });
    }

    function toggleBannerFields() {
        var type = $('#type').val();

        if (type === 'video') {
            $('#image_fields').hide();
            $('#video_fields').show();
            $('#image').prop('required', false);
            $('#alt_text').prop('required', false);
            $('#video').prop('required', true);
        } else if (type === 'image') {
            $('#image_fields').show();
            $('#video_fields').hide();
            $('#image').prop('required', true);
            $('#alt_text').prop('required', true);
            $('#video').prop('required', false);
        } else {
            // nothing selected yet -> keep both hidden
            $('#image_fields').hide();
            $('#video_fields').hide();
        }
    }
});

// ---------------- CLIENT-SIDE VALIDATION (Add/Edit Banner form) ----------------
$(document).ready(function () {
    var $form = $('#bannerForm');
    if ($form.length === 0) return;

    $form.on('submit', function (e) {
        var isValid = true;

        // reset previous state
        $form.find('.is-invalid').removeClass('is-invalid');

        // Always-required fields
        var alwaysRequired = ['#title', '#type', '#description'];

        alwaysRequired.forEach(function (sel) {
            var $field = $(sel);
            if ($field.length === 0) return;

            var val = $field.val();

            // special case: summernote editor for description
            if (sel === '#description') {
                val = $('#description').summernote('code').replace(/<(.|\n)*?>/g, '').trim();
            }

            if (!val || val.trim() === '') {
                $field.addClass('is-invalid');
                isValid = false;
            }
        });

        // Conditional fields based on selected type
        var type = $('#type').val();

        var allowedImageTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp']; // jpeg, png, jpg, gif, webp
        var maxImageSize = 2 * 1024 * 1024; // 2MB

        var allowedVideoTypes = ['video/mp4', 'video/quicktime', 'video/x-msvideo']; // mp4, mov, avi
        var maxVideoSize = 20 * 1024 * 1024; // 20MB

        if (type === 'image') {
            var $imageInput = $('#image');
            var hasExistingImage = $imageInput.data('has-existing') === true;

            if ($imageInput.length && $imageInput[0].files.length === 0 && !hasExistingImage) {
                $imageInput.addClass('is-invalid');
                $imageInput.next('.invalid-feedback').text('The banners image field is required.');
                isValid = false;
            } else if ($imageInput.length && $imageInput[0].files.length > 0) {
                var imgFile = $imageInput[0].files[0];

                if (allowedImageTypes.indexOf(imgFile.type) === -1) {
                    $imageInput.addClass('is-invalid');
                    $imageInput.next('.invalid-feedback').text('Only jpeg, png, jpg, gif, webp images are allowed.');
                    isValid = false;
                } else if (imgFile.size > maxImageSize) {
                    $imageInput.addClass('is-invalid');
                    $imageInput.next('.invalid-feedback').text('Image size must not be greater than 2MB.');
                    isValid = false;
                }
            }

            // Mobile image (optional field, but validate type/size if a file is chosen)
            var $mobileImageInput = $('input[name="mobile_image"]');
            if ($mobileImageInput.length && $mobileImageInput[0].files.length > 0) {
                var mobileImgFile = $mobileImageInput[0].files[0];
                if (allowedImageTypes.indexOf(mobileImgFile.type) === -1) {
                    $mobileImageInput.addClass('is-invalid');
                    isValid = false;
                } else if (mobileImgFile.size > maxImageSize) {
                    $mobileImageInput.addClass('is-invalid');
                    isValid = false;
                }
            }

            var $altInput = $('#alt_text');
            if ($altInput.length && (!$altInput.val() || $altInput.val().trim() === '')) {
                $altInput.addClass('is-invalid');
                isValid = false;
            }
        } else if (type === 'video') {
            var $videoInput = $('#video');
            var hasExistingVideo = $videoInput.data('has-existing') === true;

            if ($videoInput.length && $videoInput[0].files.length === 0 && !hasExistingVideo) {
                $videoInput.addClass('is-invalid');
                $videoInput.next('.invalid-feedback').text('The banners video field is required.');
                isValid = false;
            } else if ($videoInput.length && $videoInput[0].files.length > 0) {
                var vidFile = $videoInput[0].files[0];

                if (allowedVideoTypes.indexOf(vidFile.type) === -1) {
                    $videoInput.addClass('is-invalid');
                    $videoInput.next('.invalid-feedback').text('Only mp4, mov, avi videos are allowed.');
                    isValid = false;
                } else if (vidFile.size > maxVideoSize) {
                    $videoInput.addClass('is-invalid');
                    $videoInput.next('.invalid-feedback').text('Video size must not be greater than 20MB.');
                    isValid = false;
                }
            }

            // Mobile video (optional field, but validate type/size if a file is chosen)
            var $mobileVideoInput = $('input[name="mobile_video"]');
            if ($mobileVideoInput.length && $mobileVideoInput[0].files.length > 0) {
                var mobileVidFile = $mobileVideoInput[0].files[0];
                if (allowedVideoTypes.indexOf(mobileVidFile.type) === -1) {
                    $mobileVideoInput.addClass('is-invalid');
                    isValid = false;
                } else if (mobileVidFile.size > maxVideoSize) {
                    $mobileVideoInput.addClass('is-invalid');
                    isValid = false;
                }
            }
        }

        if (!isValid) {
            e.preventDefault();
            // scroll to first invalid field
            var $first = $form.find('.is-invalid').first();
            if ($first.length) {
                $('html, body').animate({ scrollTop: $first.offset().top - 100 }, 300);
            }
        }
    });

    // remove is-invalid as soon as user starts fixing the field
    $form.on('input change', 'input, textarea, select', function () {
        $(this).removeClass('is-invalid');
    });
});
