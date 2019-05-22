<div class="modal fade"  role="dialog" id="add-edit-group-modal" style="display: none;">
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
                                <h3 class="box-title" id="modal-group-title">@lang('messages.add_group')</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" name="add-group-form" id="add-group-form" enctype="multipart/form-data" >
                                <div class="box-body">
                                    <div class="form-group">
                                        <label class="col-sm-offset-2 col-sm-3 control-label" for="title">@lang('messages.title')</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder="@lang('messages.title')" name="title" id="title"
                                                   value="">
                                            <strong class="help-block title_error"></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-offset-2 col-sm-3 control-label" for="title">@lang('messages.desc')</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" rows="3" name="desc" id="desc" placeholder="@lang('messages.desc')"></textarea>
                                            <strong class="help-block desc_error"></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-offset-5 col-sm-3 text-center">
                                            <button type="submit" class="btn btn-warning" id="save-group">@lang('messages.save')</button>
                                        </div>
                                        <div class="col-sm-3 text-center">
                                            <button type="button" data-dismiss="modal" class="btn btn-default close-group-modal">@lang('messages.cancel')
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
