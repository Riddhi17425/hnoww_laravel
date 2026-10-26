$(document).ready(function () {
    var table = $('#reviewTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getReviews,
            data: function (d) {
                d.status = $('#status').val();
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'photo', name: 'photo', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'city', name: 'city' },
            { data: 'rating', name: 'rating' },
            { data: 'description', name: 'description' },
            { data: 'status', name: 'status', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#status').change(function () {
        table.draw();
    });

    $(document).on('click', '.delete-review', function () {
        var url = window.APP_URLS.deleteReview.replace(':id', $(this).data('id'));
        if (!confirm('Are you sure you want to delete this review?')) return;
        $.ajax({
            url: url,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': window.APP_URLS.csrfToken },
            success: function (response) {
                $('#message-pop-up').show().removeClass('alert-warning').addClass('alert-success');
                $('#success-message').html(response.message);
                setTimeout(function () { $('#message-pop-up').hide(); }, 3000);
                table.draw(false);
            },
            error: function () {
                alert('Something went wrong!');
            }
        });
    });
});

function updateStatus(status, id) {
    $.ajax({
        url: window.APP_URLS.updateStatus,
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': window.APP_URLS.csrfToken },
        data: { id: id, status: status },
        success: function (response) {
            $('#message-pop-up').show().removeClass('alert-warning').addClass('alert-success');
            $('#success-message').html(response.message);
            setTimeout(function () { $('#message-pop-up').hide(); }, 3000);
            $('#reviewTable').DataTable().ajax.reload(null, false);
        },
        error: function () {
            alert('Server error');
        }
    });
}
