$(document).ready(function () {
    var table = $('#ceremonialTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getCeremonials,
            data: function(d) {
                d.status = $('#status').val(); // send dropdown value
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'image', name: 'image', orderable: false, searchable: false  },
            { data: 'status', name: 'status', orderable: false, searchable: false  },
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
            $('#ceremonialTable').DataTable().ajax.reload(null, false);
        },
        error: function () {
            alert('Server error');
        }
    });
}

$(document).on('click', '.delete-ceremonial', function () {
    let id = $(this).data('id');
    let url = window.APP_URLS.deleteCeremonial.replace('__ID__', id);

    if (!confirm("Are you sure you want to delete this Ceremonial?")) return;

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

                $('#ceremonialTable').DataTable().ajax.reload(null, false);
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
