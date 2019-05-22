<div class="modal fade"  role="dialog" id="add-edit-question-modal" style="display: none;">
    <div class="modal-dialog modal-lg" role="">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h3 class="box-title" id="modal-question-title">@lang('messages.add_question')</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" name="add-question-form" id="add-question-form" enctype="multipart/form-data" >
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-offset-2 col-sm-3 control-label" for="title">@lang('messages.question')</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="@lang('messages.question')" name="question" id="question"
                                                   value="">
                                            <strong class="help-block question_error"></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-offset-2 col-sm-3 control-label" for="title">@lang('messages.response')</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="@lang('messages.response')" name="response" id="response"
                                                   value="">
                                            <strong class="help-block response_error"></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-offset-2 col-sm-3 control-label" for="group">@lang('messages.group')</label>
                                        <div class="col-sm-6">
                                            <select name="group" id="group" class="form-control selectpicker select2" style="width:100%;">
                                            </select>
                                            <div class="help-block error_group"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-offset-5 col-sm-3 text-center">
                                            <button type="submit" class="btn btn-warning" id="save-question">@lang('messages.save')</button>
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <button type="button" data-dismiss="modal" class="btn btn-default close-question-modal">@lang('messages.cancel')
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div><!-- /.modal-content -->
