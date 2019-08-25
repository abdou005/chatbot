@extends('dashboard.dashboard')
@section('title')
    @lang('messages.Stat')
@endsection
@section('contentPage')
    @include('dashboard.graph.pages.graphs-list')
@endsection
@section('stats','active')
@prepend('stylesForAc')
@endprepend
@prepend('scriptsForAc')
<script src="{{asset('plugins/chartjs/Chart.min.js')}}"></script>
<script src="{{asset('js/global.js')}}"></script>
<script src="{{asset('js/graphs/graphs.js')}}"></script>
@endprepend
