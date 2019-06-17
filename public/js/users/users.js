
var usersTable = $('#users-table').DataTable({
    //searchDelay: 3000,
    "processing": true,
    "serverSide": true,
    "pageLength": 10,
    // "bLengthChange": false,
    "searching": false,
    columns: [
        {name: 'first_name', data: 'first_name'},
        {name: 'last_name', data: 'last_name' },
        {name: 'image', data: 'image' },
        {name: 'email', data: 'email' },
        {name: 'status', data: 'status' },
        {name: 'action', data: null}
    ],
    "columnDefs": [
        {"orderable": false, "targets": '_all'},
        {
            "className": "dt-center",
            "targets": "_all"
        }
    ],
    "language": {
        processing: '<div class="loader loader--snake"></div>',
        "lengthMenu": lengthMenu,
        "zeroRecords": zeroRecords,
        "info": info,
        "infoEmpty": infoEmpty,
        "infoFiltered": infoFiltered,
        "paginate": {
            "previous": paginate_previous,
            "next": paginate_next
        }
    },
    "ajax": {
        url: '',
        "data": function(data){
            data.name_search = $('#name_search').val();
        },
        type: "get",
        dataType: 'json',
        beforeSend: function () {
            $('#users-table').addClass('table-opacity');
        },
        complete: function () {
            $('#users-table').removeClass('table-opacity');
        },
        error: function (msg) {
            console.log('error '+JSON.stringify(msg));
        }
    },
    "createdRow": function ( row, data, index ) {
        var deleteButton='<a class="btn btn-danger btn-sm" ' +
            'data-user-id="'+data['id']+'" ' +
            'data-toggle="confirmation" ' +
            'data-btn-ok-label="'+supprimer+'" ' +
            'data-btn-ok-icon="fa fa-remove" ' +
            'data-btn-ok-class="btn btn-sm btn-danger" ' +
            'data-btn-cancel-label="'+annuler+'" ' +
            'data-btn-cancel-icon="fa fa-chevron-circle-left" ' +
            'data-btn-cancel-class="btn btn-sm btn-default" ' +
            'data-title="'+deleteMessage+'" ' +
            'data-placement="left" ' +
            'data-singleton="true">' +
            '<i class="fa fa-trash-o"></i>' +
            '</a>';
        // var editButton = '<a class="btn btn-info btn-sm edit-user" style="margin: 2px;" data-user-id="'+data['id']+'" ><i class="fa fa-pencil"></i> </a>';
        var image = '<a class="showImage" data-path="'+data['image']+'" data-title="'+data['first_name']+'"><img src="'+data['image']+'" class="thumbnail"></a>';
        var checked = '';
        if (data['status'] === 1){
            checked = 'checked';
        }
        var checkedBtn = '<label class="switch">\n' +
            '                    <input type="checkbox" '+checked+' class="status-user" data-user-id="'+data['id']+'">\n' +
            '                    <span class="slider"></span>\n' +
            '                </label>';
        $('td', row).eq(0).empty().append('<span class="font-blue-steel bold">'+data['first_name']+'</span>');
        $('td', row).eq(1).empty().append('<span class="font-blue-steel bold">'+data['last_name']+'</span>');
        $('td', row).eq(2).empty().append(image);
        $('td', row).eq(3).empty().append('<span class="font-blue-steel bold">'+data['email']+'</span>');
        $('td', row).eq(4).empty().append(checkedBtn);
        $('td', row).eq(5).empty().append(deleteButton);
    }
});

$('#name_search').on('keyup', function () {
    setTimeout(function(){
        usersTable.ajax.reload();
    }, 1000);
});
$( "#users-table").on( "click",".showImage", function( event ) {
    $('#modalImage').modal('toggle');
    showImage($(this).data('path'));
});
$( "#users-table").on( "click",".status-user", function( event ) {
    var userId = $(this).data('userId');
    updateStatus(userId);
    console.log(userId);
    console.log('status click');
});

/**
 * when user click confirmation YES delete User
 */
$('body').confirmation({
    rootSelector: 'body',
    selector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
        deleteUser($(this).data('userId'));
    }
});
/**
 * ajax function
 * @param userId
 */
function deleteUser(userId) {
    var urlDelete = window.location.pathname + (window.location.pathname.slice(-1) == '/' ? '' : '/') +userId;
    $.ajax({
        method : 'DELETE',
        url : urlDelete
    }).done(function(data){
        displayMessage(data.message, 'panelSuccess', 1000);
        usersTable.ajax.reload();
    }).error(function (data) {
        console.log(data);
        displayMessage(data.responseJSON.message, 'panelError', 2000);
    });
}

/**
 * ajax function
 * @param userId
 */
function updateStatus(userId) {
    $.ajax({
        method : 'POST',
        url : '/user/status/'+userId
    }).done(function(data){
        displayMessage(data.message, 'panelSuccess', 1000);
        usersTable.ajax.reload();
    }).error(function (data) {
        console.log(data);
        displayMessage(data.responseJSON.message, 'panelError', 2000);
    });
}