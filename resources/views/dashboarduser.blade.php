@php
use Carbon\Carbon;
Carbon::setLocale('es');

@endphp

<head>
    <title>Beautysys</title>

    {{--  PWA  --}}
    @laravelPWA
</head>

@extends('layout.template')

@section('content')

    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">





      @include('layout.footer')
    </div>

@endsection
