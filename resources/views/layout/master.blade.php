<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Document</title>
  {{-- JS --}}
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="/js/uikit/uikit.js"></script>
  {{-- CSS --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link rel="stylesheet" href="/css/app.css">
</head>
<body>
  @include('layout.navbar')
  @yield('content')
  @include('layout.navbar_offcanvas')
  {{-- <script src="/js/app.js"></script> --}}
</body>
</html>