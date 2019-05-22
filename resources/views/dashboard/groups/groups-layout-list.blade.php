@extends('dashboard.dashboard')
@section('title')
    @lang('messages.groups')
@endsection
@section('contentPage')
    @include('dashboard.groups.pages.groups-list')
@endsection
@section('groups','active')
@prepend('stylesForAc')
@endprepend
@prepend('scriptsForAc')
<!-- DataTables -->
<script src="{{asset('plugins/Bootstrap-Confirmation/bootstrap-confirmation.js')}}"></script>
<script src="{{asset('plugins/Datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/Datatables/dataTables.bootstrap.js')}}"></script>
<script>
    var deleteMessage = '{{trans('messages.delete_group')}}';
    var supprimer ='{{trans('messages.delete')}}';
    var annuler = '{{trans('messages.cancel')}}';
    var editGroupMessageTitle = '{{trans('messages.edit_group')}}';
    var addGroupMessageTitle= '{{trans('messages.add_group')}}';
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
<script src="{{asset('js/groups/groups.js')}}"></script>
@endprepend
@prepend('modals')
@include('dashboard.groups.modals.add-edit-group')
@endprepend
