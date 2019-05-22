@extends('dashboard.dashboard')
@section('title')
    @lang('messages.profile')
@endsection
@section('contentPage')
    @include('dashboard.profile.pages.profile-list')
@endsection
@section('profile','active')
@prepend('stylesForAc')
<style>
    .nav-tabs-custom > .nav-tabs > li.active {
        border-top-color: #FB942F;
    }
    .profile-user-img {
        border: 3px solid #FB942F;
    }
</style>
@endprepend
