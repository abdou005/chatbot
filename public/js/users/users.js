
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
        var image = '<a class="showImage" data-path="'+data['image']+'" data-title="'+data['first_name']+'"><img src="'+data['image']+'" class="thumbnail"></a>';
        var checked = '';
        if (data['status'] === 1){
            checked = 'checked';
        }
        var checkedBtn = '<label class="switch">\n' +
            '                    <input type="checkbox" '+checked+' class="status-user" data-user-id="'+data['id']+'">\n' +
            '                    <span class="slider"></span>\n' +
            '                </label>';
        var editButton = '<a class="btn btn-info btn-sm edit-user" style="margin:2px;" data-user-id="'+data['id']+'" ><i class="fa fa-pencil"></i> </a>';

        $('td', row).eq(0).empty().append('<span class="font-blue-steel bold">'+data['first_name']+'</span>');
        $('td', row).eq(1).empty().append('<span class="font-blue-steel bold">'+data['last_name']+'</span>');
        $('td', row).eq(2).empty().append(image);
        $('td', row).eq(3).empty().append('<span class="font-blue-steel bold">'+data['email']+'</span>');
        $('td', row).eq(4).empty().append(checkedBtn);
        $('td', row).eq(5).empty().append(deleteButton+editButton);
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
 * Clear addEditGroupForm form ,clear inputs when the user close the modal window
 */
$("#add-edit-user-modal").on("hidden.bs.modal", function () {
    $('.form-group div').removeClass('has-error');
    $('.help-block').empty();
    $('#save-user').prop('disabled',false);
    $('#add-user-form').attr('action','');
    $('#add-user-form .image-holder').html('');
    $('.div-image').hide();
    $('#modal-user-title').html(addUserMessageTitle);
    $(this).find("input")
        .val('')
        .end();
});

/**
 * ajax function when user submit form
 * Add Edit User
 */
$(function(){
    $('#add-user-form').submit(function (event) {
        event.preventDefault();
        $('#save-user').prop('disabled',true);
        var formData = new FormData($('#add-user-form')[0]);
        var url = $('#add-user-form')[0].action;
        $.ajax({
            method : 'POST',
            url : url,
            data : formData,
            contentType: false,
            processData: false
        }).done(function (data) {
            displayMessage(data.message, 'panelSuccess', 1000);
            usersTable.ajax.reload();
            $('#add-edit-user-modal').modal('toggle');
        }).error(function (data) {
            $('#save-user').prop('disabled',false);
            var errors = data.responseJSON.errors;
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $.each(errors, function( index, value ) {
                $("."+index+"_error ").append("<strong>"+value.join('<br/>')+"</strong>");
                $('.'+index+"_error ").parent().addClass('has-error');
            })
        });
    });
});

/**
 *Attach Click event to editUser class using delegation
 */
$(function () {
    $( "#users-table" ).on( "click",".edit-user", function( event ) {
        event.preventDefault();
        var userId = ($(this).data('userId'));
        $('#add-user-form').attr('action', window.location.pathname + (window.location.pathname.slice(-1) == '/' ? '' : '/') +userId);
        $('#modal-user-title').html(editUserMessageTitle);
        onEditUserClick();
    });
});

/**
 * Ajax function edit User
 */
function onEditUserClick(){
    var url = $('#add-user-form')[0].action;
    $.ajax({
        method : 'GET',
        url : url,
        data : {}
    }).done(function (user) {
        $("#first_name").val(user.first_name);
        $("#last_name").val(user.last_name);
        $("#email").val(user.email);
        $("#password").val(user.pwd_c);
        $('.div-image').show();
        $('#add-user-form .image-holder').html('<input type="hidden" name="old_image" value="'+user.image+'" /> <img src="'+user.image+'">');
        $('#add-edit-user-modal').modal('toggle');
    }).error(function (data) {
    });
}

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