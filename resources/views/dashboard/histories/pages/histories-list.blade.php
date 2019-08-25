<!-- Content Header (Page header) -->
<div class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.dashboard')</a></li>
        <li><a href="#">@lang('messages.histories')</a></li>
        <li class="active">@lang('messages.list')</li>
    </ol>
</div>
<!-- Main content -->
<section class="content">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <!-- DIRECT CHAT -->
            <div class="box box-warning direct-chat direct-chat-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">@lang('messages.histories')</h3>

                    <div class="box-tools pull-right">
                        <span data-toggle="tooltip" title="3 New Messages" class="badge bg-yellow">0</span>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="col-sm-12">
                        <div class="box-body">
                            <div class="col-sm-8 col-sm-offset-2">
                                <div class="form-group">
                                    <label for="name" class="control-label">Groupe</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <select name="group" id="group" class="form-control selectpicker select2" style="width:100%;">
                                        </select>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" style="height: 500px;">
                        <div class="direct-chat-msg">
                            <div class="direct-chat-msg right">
                                    <div class="direct-chat-info clearfix">
                                            <span class="direct-chat-name pull-right">ChatBot</span>
                                        </div>
                                    <img class="direct-chat-img" src="/img/chat-boot-img.png" alt="message user image">
                                    <div class="direct-chat-text">Bonjour, {{\Illuminate\Support\Facades\Auth::user()->first_name.' '.\Illuminate\Support\Facades\Auth::user()->last_name }}.
                                    <p>Veuillez saisir ou sélectionner votre question.</p>
                                    </div>
                            </div>
                        </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <form name="add-question-form" id="add-question-form">
                        <div class="input-group">
                            <input type="text" name="question" placeholder="Type Message ..." id="question" class="form-control" required>
                            <span class="input-group-btn">
                            <button type="submit" class="btn btn-warning btn-flat" id="submit-question">Send</button>
                          </span>
                        </div>
                    </form>
                    <br>
                    <div class="row">
                        <div class="col-sm-12 question-div">
                        </div>
                    </div>
                </div>
                <!-- /.box-footer-->
            </div>
            <!--/.direct-chat -->
        </div>
        <!-- /.col -->
    </div>
</section>
<!-- /.content -->

