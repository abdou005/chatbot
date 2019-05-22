
var groupsTable = $('#groups-table').DataTable({
    //searchDelay: 3000,
    "processing": true,
    "serverSide": true,
    "pageLength": 10,
    // "bLengthChange": false,
    "searching": false,
    columns: [
        {name: 'title', data: 'title'},
        {name: 'desc', data: 'desc' },
        {name: 'questions_count', data: 'questions_count' },
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
            'data-group-id="'+data['id']+'" ' +
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
        var editButton = '<a class="btn btn-info btn-sm edit-group" style="margin:2px;" data-group-id="'+data['id']+'" ><i class="fa fa-pencil"></i> </a>';
        $('td', row).eq(0).empty().append('<span class="font-blue-steel bold">'+data['title']+'</span>');
        $('td', row).eq(1).empty().append('<span class="font-blue-steel bold">'+data['desc']+'</span>');
        $('td', row).eq(2).empty().append('<span class="font-blue-steel bold">'+data['questions_count']+'</span>');
        $('td', row).eq(3).empty().append(editButton+' '+deleteButton);
    }
});

$('#name_search').on('keyup', function () {
    setTimeout(function(){
        groupsTable.ajax.reload();
    }, 1000);
});
/**
 * when user click confirmation YES delete Group
 */
$('body').confirmation({
    rootSelector: 'body',
    selector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
        deleteGroup($(this).data('groupId'));
    }
});
/**
 * Clear addEditGroupForm form ,clear inputs when the user close the modal window
 */
$("#add-edit-group-modal").on("hidden.bs.modal", function () {
    $('.form-group div').removeClass('has-error');
    $('.help-block').empty();
    $('#save-group').prop('disabled',false);
    $('#add-group-form').attr('action','');
    $('#modal-group-title').html(addGroupMessageTitle);
    $(this).find("input")
        .val('')
        .end();
    $(this).find("textarea")
        .val('')
        .end();
});
/**
 * ajax function when user submit form
 * Add Edit Group
 */
$(function(){
    $('#add-group-form').submit(function (event) {
        event.preventDefault();
        $('#save-group').prop('disabled',true);
        var formData = new FormData($('#add-group-form')[0]);
        var url = $('#add-group-form')[0].action;
        $.ajax({
            method : 'POST',
            url : url,
            data : formData,
            contentType: false,
            processData: false
        }).done(function (data) {
            displayMessage(data.message, 'panelSuccess', 1000);
            groupsTable.ajax.reload();
            $('#add-edit-group-modal').modal('toggle');
        }).error(function (data) {
            $('#save-group').prop('disabled',false);
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
 *Attach Click event to editGroup class using delegation
 */
$(function () {
    $( "#groups-table" ).on( "click",".edit-group", function( event ) {
        event.preventDefault();
        var groupId = ($(this).data('groupId'));
        $('#add-group-form').attr('action', window.location.pathname + (window.location.pathname.slice(-1) == '/' ? '' : '/') +groupId);
        $('#modal-group-title').html(editGroupMessageTitle);
        onEditGroupClick();
    });
});
/**
 * Ajax function edit Group
 */
function onEditGroupClick(){
    var url = $('#add-group-form')[0].action;
    $.ajax({
        method : 'GET',
        url : url,
        data : {}
    }).done(function (group) {
        $("#title").val(group.title);
        $('#desc').val(group.desc);
        $('#add-edit-group-modal').modal('toggle');
    }).error(function (data) {
    });
}
/**
 * ajax function
 * @param groupId
 */
function deleteGroup(groupId) {
    var urlDelete = window.location.pathname + (window.location.pathname.slice(-1) == '/' ? '' : '/') +groupId;
    $.ajax({
        method : 'DELETE',
        url : urlDelete
    }).done(function(data){
        displayMessage(data.message, 'panelSuccess', 1000);
        groupsTable.ajax.reload();
    }).error(function (data) {
        displayMessage(data.responseJSON.message, 'panelError', 2000);
    });
}