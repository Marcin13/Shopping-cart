<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>
<body>
@livewire('header')
{{--@include('layouts.header')--}}

<div class="mx-auto">
    {{ $slot }}
</div>

@livewireScripts
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<x-livewire-alert::scripts />
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
