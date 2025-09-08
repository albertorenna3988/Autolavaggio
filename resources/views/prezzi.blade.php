@extends('layouts.app')

@section('content')
<style>
    .prezzi-fullscreen img {
        width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }
    .main-content {
        padding-top: 0;
    }
</style>

<div class="prezzi-fullscreen">
    <img src="{{ asset('images/listino.jpg') }}" alt="">
    <img src="{{ asset('images/listino2.jpg') }}" alt="">
</div>
@endsection
