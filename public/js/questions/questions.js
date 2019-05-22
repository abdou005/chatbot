
/**
 * initialize select2
 */
$(function () {
    $(".select2").select2();
});
var questionsTable = $('#questions-table').DataTable({
    //searchDelay: 3000,
    "processing": true,
    "serverSide": true,
    "pageLength": 10,
    // "bLengthChange": false,
    "searching": false,
    columns: [
        {name: 'question', data: 'question'},
        {name: 'response', data: 'response' },
        {name: 'group_id', data: 'group_id' },
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
            'data-question-id="'+data['id']+'" ' +
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
        var editButton = '<a class="btn btn-info btn-sm edit-question" style="margin:2px;" data-question-id="'+data['id']+'" ><i class="fa fa-pencil"></i> </a>';
        $('td', row).eq(0).empty().append('<span class="font-blue-steel bold">'+data['question']+'</span>');
        $('td', row).eq(1).empty().append('<span class="font-blue-steel bold">'+data['response']+'</span>');
        $('td', row).eq(2).empty().append('<span class="font-blue-steel bold">'+data['group']['title']+'</span>');
        $('td', row).eq(3).empty().append(editButton+' '+deleteButton);
    }
});

$('#name_search').on('keyup', function () {
    setTimeout(function(){
        questionsTable.ajax.reload();
    }, 1000);
});
/**
 * when user click confirmation YES delete Question
 */
$('body').confirmation({
    rootSelector: 'body',
    selector: '[data-toggle=confirmation]',
    onConfirm: function (event, element) {
        deleteQuestion($(this).data('questionId'));
    }
});
/**
 * Clear addEditQuestionForm form ,clear inputs when the user close the modal window
 */
$("#add-edit-question-modal").on("hidden.bs.modal", function () {
    $('.form-group div').removeClass('has-error');
    $('.help-block').empty();
    $('#save-question').prop('disabled',false);
    $('#add-question-form').attr('action','');
    $('#modal-question-title').html(addQuestionMessageTitle);
    $(this).find(".select2")
        .val('')
        .change();
    $(this).find("input")
        .val('')
        .end();
    $(this).find("textarea")
        .val('')
        .end();
});
/**
 * ajax function when user submit form
 * Add Edit Guestion
 */
$(function(){
    $('#add-question-form').submit(function (event) {
        event.preventDefault();
        $('#save-question').prop('disabled',true);
        var formData = new FormData($('#add-question-form')[0]);
        var url = $('#add-question-form')[0].action;
        $.ajax({
            method : 'POST',
            url : url,
            data : formData,
            contentType: false,
            processData: false
        }).done(function (data) {
            displayMessage(data.message, 'panelSuccess', 1000);
            questionsTable.ajax.reload();
            $('#add-edit-question-modal').modal('toggle');
        }).error(function (data) {
            $('#save-question').prop('disabled',false);
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
 *Attach Click event to editQuestion class using delegation
 */
$(function () {
    $( "#questions-table" ).on( "click",".edit-question", function( event ) {
        event.preventDefault();
        var questionId = ($(this).data('questionId'));
        $('#add-question-form').attr('action', window.location.pathname + (window.location.pathname.slice(-1) == '/' ? '' : '/') +questionId);
        $('#modal-question-title').html(editQuestionMessageTitle);
        onEditQuestionClick();
    });
});
/**
 * Ajax function edit Question
 */
function onEditQuestionClick(){
    var url = $('#add-question-form')[0].action;
    $.ajax({
        method : 'GET',
        url : url,
        data : {}
    }).done(function (question) {
        $("#question").val(question.question);
        $('#response').val(question.response);
        $('#add-edit-question-modal').modal('toggle');
    }).error(function (data) {
    });
}
/**
 * ajax function
 * @param questionId
 */
function deleteQuestion(questionId) {
    var urlDelete = window.location.pathname + (window.location.pathname.slice(-1) == '/' ? '' : '/') +questionId;
    $.ajax({
        method : 'DELETE',
        url : urlDelete
    }).done(function(data){
        displayMessage(data.message, 'panelSuccess', 1000);
        questionsTable.ajax.reload();
    }).error(function (data) {
        displayMessage(data.responseJSON.message, 'panelError', 2000);
    });
}

/**
 * load groups Select
 */
$(function () {
    $("#group").select2({
        //placeholder: select_entity_placeholder,
        ajax: {
            url: '/groups-select',
            delay: 250,
            data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
            },
            processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                        more: (params.page * 15) < data.total_count
                    }
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
        minimumInputLength: 1,
        templateResult: function formatRepo (repo) {
            if (repo.loading) return repo.text;
            var markup = "<div><span class='fa fa-pencil fa-3'></span>&nbsp;&nbsp;<b>" + repo.text + "</b></div>";
            //return markup;
            return markup;
        }, // omitted for brevity, see the source of this pages
        templateSelection: function formatRepoSelection (repo) {
            return repo.text;
        }// omitted for brevity, see the source of this pagesl


    });
});