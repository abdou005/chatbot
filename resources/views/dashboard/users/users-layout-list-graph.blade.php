@extends('dashboard.dashboard')
@section('title')
    @lang('messages.users_stat')
@endsection
@section('contentPage')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <h1>
            <small></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.dashboard')</a></li>
            <li><a href="#">@lang('messages.users_stat')</a></li>
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
                            <canvas id="salesChart" style="height: 180px;"></canvas>
                        </div>
                        <!-- /.chart-responsive -->
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('users_stat','active')
@prepend('stylesForAc')

@endprepend
@prepend('scriptsForAc')
<!-- ChartJS 1.0.1 -->
<script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script>
<script src="{{asset('js/global.js')}}"></script>
<script src="{{asset('js/users/graph.js')}}"></script>
@endprepend
