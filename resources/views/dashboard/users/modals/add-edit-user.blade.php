<div class="modal fade"  role="dialog" id="add-edit-user-modal" style="display: none;">
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
                                <h3 class="box-title" id="modal-user-title">@lang('messages.add_user')</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" name="add-user-form" id="add-user-form" enctype="multipart/form-data" >
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="first_name" class="col-sm-2 control-label">@lang('messages.first_name')</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="first_name" class="form-control" id="first_name" placeholder="@lang('messages.first_name')" value="" autofocus>
                                            <strong class="help-block first_name_error"></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="last_name" class="col-sm-2 control-label">@lang('messages.last_name')</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="@lang('messages.last_name')" value="">
                                            <strong class="help-block last_name_error"></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="col-sm-2 control-label">@lang('messages.email')</label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="@lang('messages.email')" value="">
                                            <strong class="help-block email_error"></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="col-sm-2 control-label">@lang('messages.password')</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="password" class="form-control" id="password" placeholder="@lang('messages.password')" value="">
                                            <strong class="help-block password_error"></strong>
                                        </div>
                                    </div>
                                    <div class="form-group div-image" style="display: none;">
                                        <label class="control-label col-sm-2"></label>
                                        <div class="col-sm-10 image-holder">
                                            <div class=""></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image" class="col-sm-2 control-label">@lang('messages.image')</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="image" class="form-control" accept="image/*" id="image" placeholder="@lang('messages.image')">
                                            <strong class="help-block image_error"></strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <div class="row">
                                        <div class="col-sm-offset-5 col-sm-3 text-center">
                                            <button type="submit" class="btn btn-warning" id="save-user">@lang('messages.save')</button>
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
