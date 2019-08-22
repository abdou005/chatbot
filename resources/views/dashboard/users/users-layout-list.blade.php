@extends('dashboard.dashboard')
@section('title')
    @lang('messages.users')
@endsection
@section('contentPage')
    @include('dashboard.users.pages.users-list')
@endsection
@section('users','active')
@prepend('stylesForAc')
<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #3c763d;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #3c763d;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
</style>
@endprepend
@prepend('scriptsForAc')
<!-- DataTables -->
<script src="{{asset('plugins/Bootstrap-Confirmation/bootstrap-confirmation.js')}}"></script>
<script src="{{asset('plugins/Datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/Datatables/dataTables.bootstrap.js')}}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script>

<script>
    var deleteMessage = '{{trans('messages.delete_user')}}';
    var supprimer ='{{trans('messages.delete')}}';
    var annuler = '{{trans('messages.cancel')}}';
    var editUserMessageTitle = '{{trans('messages.edit_user')}}';
    var addUserMessageTitle= '{{trans('messages.add_user')}}';
    //TRANS Jquery DataTable
    var lengthMenu = '{{trans('messages.LengthMenu')}}';
    var zeroRecords = '{{trans('messages.ZeroRecords')}}';
    var info = '{{trans('messages.Info')}}';
    var infoEmpty = '{{trans('messages.InfoEmpty')}}';
    var infoFiltered = '{{trans('messages.InfoFiltered')}}';
    var paginate_previous = '{{trans('messages.Paginate_previous')}}';
    var paginate_next = '{{trans('messages.Paginate_next')}}';
</script>
<script src="{{asset('js/global.js')}}"></script>
<script src="{{asset('js/users/users.js')}}"></script>
@endprepend
@prepend('modals')
    @include('dashboard.users.modals.add-edit-user')
@endprepend
