<!-- Content Header (Page header) -->
<div class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.dashboard')</a></li>
        <li><a href="#">@lang('messages.groups')</a></li>
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
            <h3 class="box-title"><b><i>@lang('messages.users_stat')</i></b></h3>
            <div class="box-tools pull-right">

            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">
                        <strong>Nombre de nouveaux comptes crées</strong>
                    </p>
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="graph-users" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
        </div>
    </div>

    <div class="box box-warning">
        <div class="box-header">
            <i class="ion-ios-list-outline"></i>
            <h3 class="box-title"><b><i>@lang('messages.groups_stat')</i></b></h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">
                        <strong>Nombre de nouveaux groups crées</strong>
                    </p>
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="graph-groups" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix no-border">
        </div>
    </div>

    <div class="box box-warning">
        <div id="panelSuccess" style="display:none;">
            <div class="alert alert-success">
            </div>
        </div>
        <div class="box-header">
            <i class="ion-ios-list-outline"></i>
            <h3 class="box-title"><b><i>@lang('messages.questions_stat')</i></b></h3>
            <div class="box-tools pull-right">
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">
                        <strong>Nombre de nouvelles questions crées</strong>
                    </p>
                    <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="graph-questions" style="height: 180px;"></canvas>
                    </div>
                    <!-- /.chart-responsive -->
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

