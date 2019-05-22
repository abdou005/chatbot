@extends('dashboard.layouts.app')
@section('title')
    {{trans('messages.dashboard')}}
@endsection
@section('body_class','hold-transition skin-red-light sidebar-mini')

@section('content')
    <div class="wrapper">
        @include('dashboard.sections.header')
        @include('dashboard.sections.navigation')
        <div class="content-wrapper">
            @yield('contentPage')
        </div>
        @include('dashboard.sections.footer')
        {{--@include('admin.sections.sidebar')--}}
    </div>
    <div class="modals">
        @include('dashboard.includes.modal.logout')
        @include('dashboard.includes.modal.image')
        @include('dashboard.includes.modal.confirm-modal')
        @stack('modals')
    </div>
@endsection

@section('styles')
    @stack('stylesForAc')
    <style>
        .skin-red-light .sidebar-menu > li.active > a {
            color: #000000;
            background: #FB942F;
        }
        .skin-red-light .main-header .navbar {
            background-color: #E54634;
        }
        .main-footer {
            border-top: 2px solid #E54634;
        }
        .box.box-warning {
            border-top-color: #FB942F;
        }
        .btn-warning {
            background-color: #FB942F;
            border-color: #e08e0b;
        }
    </style>
@endsection
@section('scripts')
    <!-- AdminLTE App -->
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/formdata-polyfill.js')}}"></script>
    <script>
        /**
         * add the token to all request headers. This provides simple,
         * convenient CSRF protection for your AJAX based applications:
         */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scriptsForAc')
@endsection
