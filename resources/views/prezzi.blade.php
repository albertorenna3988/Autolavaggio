@extends('layouts.app')

@section('content')
<style>
    .prezzi-fullscreen {
        padding-top: 80px; /* Spazio sotto la navbar */
    }

    @media (max-width: 768px) {
        .prezzi-fullscreen {
            padding-top: 100px; /* Più spazio sui dispositivi mobili */
        }
    }

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
    <img src="{{ asset('images/listino.jpg') }}" alt="Listino prezzi 1">
    <img src="{{ asset('images/listino2.jpg') }}" alt="Listino prezzi 2">
</div>
@endsection
