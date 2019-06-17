@extends('dashboard.dashboard')
@section('title')
    @lang('messages.histories')
@endsection
@section('contentPage')
    @include('dashboard.histories.pages.histories-list')
@endsection
@section('groups','active')
@prepend('stylesForAc')
    <link rel="stylesheet" href="{{asset('plugins/Select2/select2.min.css')}}">
@endprepend
@prepend('scriptsForAc')
    <script src="{{asset('plugins/Select2/select2.full.min.js')}}"></script>
    @if(Config::get('app.locale')=='fr')
        <script src="{{asset('plugins/Select2/fr.js')}}"></script>
    @else
        <script src="{{asset('plugins/Select2/en.js')}}"></script>
    @endif
<script>
</script>
<script src="{{asset('js/global.js')}}"></script>
    <script>
        var userName = '{{Auth::user()->first_name}} {{Auth::user()->last_name}}';
        var userImage = '{{Auth::user()->image}}';
    </script>
<script src="{{asset('js/histories/histories.js')}}"></script>
@endprepend
