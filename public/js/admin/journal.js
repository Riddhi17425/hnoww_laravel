$(document).ready(function () {
    var table = $('#journalTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getJournals,
            data: function(d) {
                d.status = $('#status').val(); // send dropdown value
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'month_name', name:"month_name" },
            { data: 'title', name: 'title' },
            { data: 'description', name: 'description' },
            { data: 'thumbnail_img', name: 'thumbnail_img', orderable: false, searchable: false  },
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
            $('#journalTable').DataTable().ajax.reload(null, false);
        },
        error: function () {
            alert('Server error');
        }
    });
}