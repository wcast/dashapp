<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <?php
    $fullurl = ($_SERVER['REQUEST_URI']);
    $trimmed = trim($fullurl, ".php");
    $canonical = rtrim($trimmed, '/');
    $server = request()->server("SERVER_NAME");
    ?>
    <meta name="description" content="{{ isset($meta['description']) ? $meta['description'] : '' }}" />
    <link rel="canonical" href="https://<?= $server ?><?= $canonical ?>" />
    <meta property="og:image" content="{{ isset($meta['photo']) ? $meta['photo'] : '' }}" itemprop="image">
    <meta property="og:image:width" content="526">
    <meta property="og:image:height" content="275">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:description" content="{{ isset($meta['description']) ? $meta['description'] : '' }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:title" content="{{ isset($meta['description']) ? $meta['description'] : '' }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('img/logo/L.ico') }}">
    @yield('page-style')
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/novo.css') }}?<?=uniqid('css-')?>">
    <link rel="stylesheet" href="{{ asset('slick/slick.css') }}?<?=uniqid('css-')?>">
    <link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}?<?=uniqid('css-')?>">
</head>
<body>
@include('layout.header')

