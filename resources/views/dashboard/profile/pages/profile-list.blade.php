<!-- Content Header (Page header) -->
<div class="content-header">
    <h1>
        <small></small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> @lang('messages.dashboard')</a></li>
        <li><a href="#">@lang('messages.profile')</a></li>
    </ol>
</div>
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <div class="box box-warning">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ Auth::user()->image}}" alt="User profile picture">
                    <h3 class="profile-username text-center">{{ Auth::user()->first_name.' '.Auth::user()->last_name }}</h3>
                    <p class="text-muted text-center">
                        @switch(Auth::user()->role)
                            @case(\App\User::ADMIN)
                            {{'Administrateur'}}
                            @break

                            @case(\App\User::VISITOR)
                            {{'Visiteur'}}
                            @break
                            @default
                            {{'Visiteur'}}
                        @endswitch
                    </p>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
            <!-- About Me Box -->
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title">À propos de moi</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> description</strong>
                    <p class="text-muted">
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> emplacement</strong>
                    <p class="text-muted"></p>
                    <hr>
                    <strong><i class="fa fa-phone margin-r-5"></i> téléphone</strong>
                    <p class="text-muted"></p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div id="panelSuccess" style="display:none;">
                <div class="alert alert-success">
                </div>
            </div>
            <div id="panelError" style="display:none;">
                <div class="alert alert-error">
                </div>
            </div>
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#settings" data-toggle="tab">Réglages</a></li>
                </ul>
                <div class="tab-content">
                    <div class="active tab-pane" id="settings">
                        <form class="form-horizontal" id="edit-user" method="post" action="{{url('/user/'.Auth::user()->id)}}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-sm-2 control-label">@lang('messages.first_name')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="@lang('messages.first_name')" value="{{Auth::user()->first_name}}" autofocus>
                                    @if ($errors->has('first_name'))<span class="help-block"><strong>{{ $errors->first('first_name') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name" class="col-sm-2 control-label">@lang('messages.last_name')</label>
                                <div class="col-sm-10">
                                    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="@lang('messages.last_name')" value="{{Auth::user()->last_name}}">
                                    @if ($errors->has('last_name'))<span class="help-block"><strong>{{ $errors->first('last_name') }}</strong></span>@endif

                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-sm-2 control-label">@lang('messages.email')</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control" id="email" placeholder="@lang('messages.email')" value="{{Auth::user()->email}}">
                                    @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif

                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                <label for="image" class="col-sm-2 control-label">@lang('messages.image')</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image" class="form-control" accept="image/*" id="image" placeholder="@lang('messages.image')">
                                    @if ($errors->has('image'))<span class="help-block"><strong>{{ $errors->first('image') }}</strong></span>@endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-warning">@lang('messages.save')</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

