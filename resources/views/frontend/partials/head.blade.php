<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>{{ config('app.name', 'IPS - Virtual Class') }}</title>
    
    <link rel="icon" href="{{ asset('frontend/assets/logo.png') }}" type="image/gif" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('frontend/library/bootstrap.min.css') }}">

    @if ($useMainCss)
	    <link rel="stylesheet" href="{{ asset('frontend/style/main.css') }}">
    @endif

    @if ($useIncourseCss)
	    <link rel="stylesheet" href="{{ asset('frontend/style/incourse.css') }}">
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;1,100;1,300;1,400;1,500&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,500&display=swap" rel="stylesheet">
    
    @if ($usePhilosopherFontFamily)
    	<link href="https://fonts.googleapis.com/css2?family=Philosopher:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    @endif

    @if ($useOwlCarouselCss)
		<link rel="stylesheet" href="{{ asset('frontend/library/owl-carousel/css/owl.carousel.min.css') }}" />
	    <link rel="stylesheet" href="{{ asset('frontend/library/owl-carousel/css/owl.theme.default.min.css') }}" />
    @endif

    @if ($useAOSCss)
    	<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    @endif
</head>