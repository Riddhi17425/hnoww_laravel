$(document).ready(function () {
    var table = $('#categoryTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getCategories,
            data: function(d) {
                d.status = $('#status').val(); // send dropdown value
                d.category_type = $('#category_type').val();
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'category_name', name:"category_name" },
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'banner_image', name: 'banner_image', orderable: false, searchable: false  },
            { data: 'category_type', name: 'category_type', searchable: false  },
            { data: 'status', name: 'status', orderable: false, searchable: false  },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    // Trigger table reload when dropdown changes
    $('#status').change(function () {
        table.draw();
    });
    $('#category_type').change(function () {
        table.draw();
    });

    $(document).on('click', '.delete-category', function () {
        let id = $(this).data('id');
        var url = window.APP_URLS.deleteCategory.replace(':id' , id);
        if (confirm("Are you sure you want to delete this Category?")) {
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
            $('#categoryTable').DataTable().ajax.reload(null, false);
        },
        error: function () {
            alert('Server error');
        }
    });
}

$(document).on("keyup", "#category_name", function() {
    var name = $(this).val();
    // Convert to lowercase, replace spaces with dash, remove special chars
    var slug = name.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');

    $('#category_url').val(slug);
});