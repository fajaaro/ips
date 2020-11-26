<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle ?? config('app.name', 'IPS - Virtual Class') }}</title>

    <!-- Page Icon -->
    <link rel="icon" href="{{ asset('frontend/assets/logo.png') }}" type="image/gif" sizes="16x16">
    
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/library/bootstrap.min.css') }}">
    
    @stack('styles')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
    
    @stack('fonts')
</head>
<body>
	@yield('navbar')

	@yield('content')

	@yield('footer')

    <script src="{{ asset('frontend/library/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/library/bootstrap.min.js') }}"></script>
    
    @stack('scripts')
</body>
</html>