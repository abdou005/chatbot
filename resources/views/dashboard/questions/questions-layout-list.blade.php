@extends('dashboard.dashboard')
@section('title')
    @lang('messages.questions')
@endsection
@section('contentPage')
    @include('dashboard.questions.pages.questions-list')
@endsection
@section('questions','active')
@prepend('stylesForAc')
<link rel="stylesheet" href="{{asset('plugins/Select2/select2.min.css')}}">
@endprepend
@prepend('scriptsForAc')
<!-- DataTables -->
<script src="{{asset('plugins/Bootstrap-Confirmation/bootstrap-confirmation.js')}}"></script>
<script src="{{asset('plugins/Datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/Datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('plugins/Select2/select2.full.min.js')}}"></script>
@if(Config::get('app.locale')=='fr')
    <script src="{{asset('plugins/Select2/fr.js')}}"></script>
@else
    <script src="{{asset('plugins/Select2/en.js')}}"></script>
@endif
<script>
    var deleteMessage = '{{trans('messages.delete_question')}}';
    var supprimer ='{{trans('messages.delete')}}';
    var annuler = '{{trans('messages.cancel')}}';
    var editQuestionMessageTitle = '{{trans('messages.edit_question')}}';
    var addQuestionMessageTitle= '{{trans('messages.add_question')}}';
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
<script src="{{asset('js/questions/questions.js')}}"></script>
@endprepend
@prepend('modals')
@include('dashboard.questions.modals.add-edit-question')
@endprepend
