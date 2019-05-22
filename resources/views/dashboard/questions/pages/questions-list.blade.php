<!-- Content Header (Page header) -->
<div class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.dashboard')</a></li>
        <li><a href="#">@lang('messages.questions')</a></li>
        <li class="active">@lang('messages.list')</li>
    </ol>
</div>
<!-- Main content -->
<section class="content">
    <div class="box box-warning">
        <div id="panelSuccess" style="display:none;">
            <div class="alert alert-success">
            </div>
        </div>
        <div class="box-header">
            <i class="ion-ios-list-outline"></i>
            <h3 class="box-title"><b><i>@lang('messages.questions_list_title')</i></b></h3>
            <div class="box-tools pull-right">
                <b><a href="" class="pull-right btn btn-sm btn-warning" data-toggle="modal"  data-backdrop="static" data-keyboard="false" data-target="#add-edit-question-modal"><i class="fa fa-plus"> @lang('messages.add')</i></a></b>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="box-body">
                        <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="name" class="control-label">question ou réponse </label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <input type="text" class="form-control" placeholder="question ou réponse" name="name" id="name_search" />
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 scrollable">
                    <table id="questions-table" class="table table-bordered table-striped" width="100%">
                        <thead>
                        <tr>
                            <th style="width: 30%">@lang('messages.question')</th>
                            <th style="width: 30%">@lang('messages.response')</th>
                            <th style="width: 30%">@lang('messages.group')</th>
                            <th style="width: 10%">@lang('messages.actions')</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
        </div>
    </div>

    <!-- /.row -->
</section>
<!-- /.content -->

