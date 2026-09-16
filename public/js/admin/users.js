$(document).ready(function () {
    var table = $('#userTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getUsers,
            data: function(d) {
               
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name:"name" },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'address', name: 'address' },
        ]
    });

    var orderTable = $('#orderTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: window.APP_URLS.getOrders,
            data: function(d) {
               d.user_id = $('#user_id').val(); // send dropdown value
            }
        },
        order: [[0, 'desc']],
        columns: [
            { data: 'order_number', name: 'order_number' },
            { data: 'user_details', name:"user_details", orderable:false, searchable:false },
            { data: 'status', name: 'status' },
            { data: 'subtotal', name: 'subtotal', render: formatAmount },
            { data: 'shipping_charges', name: 'shipping_charges', render: formatAmount },
            { data: 'order_total', name: 'order_total', render: formatAmount },
            { data: 'action', name: 'action', orderable:false, searchable:false },
        ]
    });

    function formatAmount(data) {
        var amount = parseFloat(data || 0);
        return amount.toFixed(2) + ' AED';
    }

    // Trigger table reload when dropdown changes
    $('#user_id').change(function () {
        orderTable.draw();
    });
    
    
});