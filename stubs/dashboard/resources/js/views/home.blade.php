@extends('layout.default')

@section('content')

@section('page-style')
    <link rel="stylesheet" href="{{ asset("css/home.css?v=1234") }}">
@endsection


@endsection

@section('page-scripts')
    <script src="{{ asset("js/home.js?v=1234") }}"></script>
@endsection
