
/**
 * initialize select2
 */
$(function () {
    $(".select2").select2();
});
// /**
//  * ajax function when user submit form
//  * Add History
//  */
// $(function(){
//     $('#add-group-form').submit(function (event) {
//         event.preventDefault();
//         $('#save-group').prop('disabled',true);
//         var formData = new FormData($('#add-group-form')[0]);
//         var url = $('#add-group-form')[0].action;
//         $.ajax({
//             method : 'POST',
//             url : url,
//             data : formData,
//             contentType: false,
//             processData: false
//         }).done(function (data) {
//             displayMessage(data.message, 'panelSuccess', 1000);
//             groupsTable.ajax.reload();
//             $('#add-edit-group-modal').modal('toggle');
//         }).error(function (data) {
//             $('#save-group').prop('disabled',false);
//             var errors = data.responseJSON.errors;
//             $('.form-group').removeClass('has-error');
//             $('.help-block').empty();
//             $.each(errors, function( index, value ) {
//                 $("."+index+"_error ").append("<strong>"+value.join('<br/>')+"</strong>");
//                 $('.'+index+"_error ").parent().addClass('has-error');
//             })
//         });
//     });
// });
/**
 * ajax function
 * @param groupId
 */
function addHistory(questionId) {
    var url = '/response-to-question/'+questionId;
    $('#submit-question').prop('disabled',true);
    $.ajax({
        method : 'POST',
        url : url
    }).done(function(history){
        var html = '';
        html+='                        <div class="direct-chat-msg">\n' +
            '                            <div class="direct-chat-info clearfix">\n' +
            '                                <span class="direct-chat-name pull-left">'+userName+'</span>\n' +
            '                                <span class="direct-chat-timestamp pull-right">'+history.created_at+'</span>\n' +
            '                            </div>\n' +
            '                            <img class="direct-chat-img" src="'+userImage+'" alt="message user image">\n' +
            '                            <div class="direct-chat-text">'+history.question.question+'</div>\n' +
            '                        </div>\n' +
            '                        <div class="direct-chat-msg right">\n' +
            '                            <div class="direct-chat-info clearfix">\n' +
            '                                <span class="direct-chat-name pull-right">ChatBot</span>\n' +
            '                                <span class="direct-chat-timestamp pull-left">'+history.created_at+'</span>\n' +
            '                            </div>\n' +
            '                            <img class="direct-chat-img" src="/img/chat-boot-img.png" alt="message user image">\n' +
            '                            <div class="direct-chat-text">'+history.question.response+'</div>\n' +
            '                        </div>';
    $('.direct-chat-messages').append(html);
    $('#submit-question').prop('disabled',false);
        var groupId = $('#group').val();
        var question = $('#question').val();
        loadQuestionsByGroup(groupId, question);
    }).error(function (data) {
        $('#submit-question').prop('disabled',false);
        var groupId = $('#group').val();
        var question = $('#question').val();
        loadQuestionsByGroup(groupId, question);
    });
}

$("body").on('click', '.btn-question', function(){
    var questionId = $(this).data('questionId');
    addHistory(questionId);
});

// $("#submit-question").click(function(event){
//     event.preventDefault();
//     var question = $('#question').val();
//     if (question){
//         var html = '';
//         html+='                        <div class="direct-chat-msg">\n' +
//             '                            <div class="direct-chat-info clearfix">\n' +
//             '                                <span class="direct-chat-name pull-left">'+userName+'</span>\n' +
//             '                            </div>\n' +
//             '                            <img class="direct-chat-img" src="'+userImage+'" alt="message user image">\n' +
//             '                            <div class="direct-chat-text">'+question+'</div>\n' +
//             '                        </div>\n' +
//             '                        <div class="direct-chat-msg right">\n' +
//             '                            <div class="direct-chat-info clearfix">\n' +
//             '                                <span class="direct-chat-name pull-right">ChatBot</span>\n' +
//             '                            </div>\n' +
//             '                            <img class="direct-chat-img" src="/img/chat-boot-img.png" alt="message user image">\n' +
//             '                            <div class="direct-chat-text">Aucune reponse pour cette question</div>\n' +
//             '                        </div>';
//         $('.direct-chat-messages').append(html);
//     }
// });

$(function(){
    $('#add-question-form').submit(function (event) {
        event.preventDefault();
        var groupId = $('#group').val();
        var questionTxt = $('#question').val();
        if (groupId){
            var url = '/group/'+groupId+'/add-question';
            var formData = new FormData($('#add-question-form')[0]);
            $.ajax({
                method : 'POST',
                url : url,
                data : formData,
                contentType: false,
                processData: false,
                async : false
            }).done(function (history) {
                var html = '';
                html+='                        <div class="direct-chat-msg">\n' +
                    '                            <div class="direct-chat-info clearfix">\n' +
                    '                                <span class="direct-chat-name pull-left">'+userName+'</span>\n' +
                    '                                <span class="direct-chat-timestamp pull-right">'+history.created_at+'</span>\n' +
                    '                            </div>\n' +
                    '                            <img class="direct-chat-img" src="'+userImage+'" alt="message user image">\n' +
                    '                            <div class="direct-chat-text">'+history.question.question+'</div>\n' +
                    '                        </div>\n' +
                    '                        <div class="direct-chat-msg right">\n' +
                    '                            <div class="direct-chat-info clearfix">\n' +
                    '                                <span class="direct-chat-name pull-right">ChatBot</span>\n' +
                    '                                <span class="direct-chat-timestamp pull-left">'+history.created_at+'</span>\n' +
                    '                            </div>\n' +
                    '                            <img class="direct-chat-img" src="/img/chat-boot-img.png" alt="message user image">\n' +
                    '                            <div class="direct-chat-text">'+history.question.response+'</div>\n' +
                    '                        </div>';
                $('.direct-chat-messages').append(html);
                $('#submit-question').prop('disabled',false);
                var groupId = $('#group').val();
                var question = $('#question').val();
                loadQuestionsByGroup(groupId, question);
            }).error(function (data) {
                $('#submit-question').prop('disabled',false);
                var groupId = $('#group').val();
                var question = $('#question').val();
                loadQuestionsByGroup(groupId, question);
            });
        }
    });
});

$("#question").keyup(function(){
    var groupId = $('#group').val();
    var question = $(this).val();
    loadQuestionsByGroup(groupId, question);
});
$("#group").change(function(){
   var groupId = $(this).val();
   var url = '/group/'+groupId+'/histories';
    $.ajax({
        method : 'GET',
        url : url,
        data : {}
    }).done(function (histories) {
        var html = '';
        $('.direct-chat-messages').html('');
        if(histories.length){
            $.each(histories, function (index, history) {
                html+='                        <div class="direct-chat-msg">\n' +
                    '                            <div class="direct-chat-info clearfix">\n' +
                    '                                <span class="direct-chat-name pull-left">'+userName+'</span>\n' +
                    '                                <span class="direct-chat-timestamp pull-right">'+history.created_at+'</span>\n' +
                    '                            </div>\n' +
                    '                            <img class="direct-chat-img" src="'+userImage+'" alt="message user image">\n' +
                    '                            <div class="direct-chat-text">'+history.question.question+'</div>\n' +
                    '                        </div>\n' +
                    '                        <div class="direct-chat-msg right">\n' +
                    '                            <div class="direct-chat-info clearfix">\n' +
                    '                                <span class="direct-chat-name pull-right">ChatBot</span>\n' +
                    '                                <span class="direct-chat-timestamp pull-left">'+history.created_at+'</span>\n' +
                    '                            </div>\n' +
                    '                            <img class="direct-chat-img" src="/img/chat-boot-img.png" alt="message user image">\n' +
                    '                            <div class="direct-chat-text">'+history.question.response+'</div>\n' +
                    '                        </div>';
            });
            $('.direct-chat-messages').append(html);
        }else{
            var htmlDefault = ' <div class="direct-chat-msg right">\n' +
                '                                    <div class="direct-chat-info clearfix">\n' +
                '                                            <span class="direct-chat-name pull-right">ChatBot</span>\n' +
                '                                        </div>\n' +
                '                                    <img class="direct-chat-img" src="/img/chat-boot-img.png" alt="message user image">\n' +
                '                                    <div class="direct-chat-text">Bonjour, '+userName+'<p>Veuillez saisir ou sélectionner votre question.</p>\n' +
                '                                    </div>\n' +
                '                            </div>';
            $('.direct-chat-messages').append(htmlDefault);
        }
    }).error(function (data) {
    });
});
function loadQuestionsByGroup(groupId, question){
    var urlQuestions = '/group/'+groupId+'/questions';
    $.ajax({
        method : 'GET',
        url : urlQuestions,
        data : {name:question}
    }).done(function (pagination) {
        var html = '';
        $('.question-div').html('');
        $.each(pagination.data, function (index, question) {
            html+='<button type="button" class="btn btn-default btn-block btn-flat btn-question" data-question-id="'+question.id+'">'+question.question+'</button>';
        });
        $('.question-div').append(html);
    }).error(function (data) {
    });
}
/**
 * load questions Select
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
    // $("#question").select2({
    //     //placeholder: select_entity_placeholder,
    //     ajax: {
    //         url: '/questions-select',
    //         delay: 250,
    //         data: function (params) {
    //             return {
    //                 group_id:$('#group').val(),
    //                 q: params.term, // search term
    //                 page: params.page
    //             };
    //         },
    //         processResults: function (data, params) {
    //             // parse the results into the format expected by Select2
    //             // since we are using custom formatting functions we do not need to
    //             // alter the remote JSON data, except to indicate that infinite
    //             // scrolling can be used
    //             params.page = params.page || 1;
    //
    //             return {
    //                 results: data.items,
    //                 pagination: {
    //                     more: (params.page * 15) < data.total_count
    //                 }
    //             };
    //         },
    //         cache: true
    //     },
    //     escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
    //     minimumInputLength: 1,
    //     templateResult: function formatRepo (repo) {
    //         if (repo.loading) return repo.text;
    //         var markup = "<div><span class='fa fa-pencil fa-3'></span>&nbsp;&nbsp;<b>" + repo.text + "</b></div>";
    //         //return markup;
    //         return markup;
    //     }, // omitted for brevity, see the source of this pages
    //     templateSelection: function formatRepoSelection (repo) {
    //         return repo.text;
    //     }// omitted for brevity, see the source of this pagesl
    // });
});