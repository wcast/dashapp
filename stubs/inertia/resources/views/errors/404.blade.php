@extends('layout.default')

@section('content')

    @section('page-style')
        <link rel="stylesheet" href="{{ asset("css/erro.css") }}">
    @endsection

    <div class="container" style="padding-top:80px;" >
    <h1 style="color:#d01a12 !important;">Página não encontrada</h1>
    <br/>

    <div class="clear"></div>
</div>

    @section('page-scripts')
        <script src="{{ asset("js/home.js") }}"></script>
    @endsection
@endsection
