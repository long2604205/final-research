<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="{{asset('admin/css/bootstrap-reboot.min.css')}}">
	{{-- <link rel="stylesheet" href="{{asset('admin/css/bootstrap-grid.min.css')}}"> --}}
	{{-- <link rel="stylesheet" href="{{asset('admin/css/magnific-popup.css')}}"> --}}
	{{-- <link rel="stylesheet" href="{{asset('admin/css/select2.min.css')}}"> --}}
	{{-- <link rel="stylesheet" href="{{asset('admin/css/admin.css')}}"> --}}

    <link rel="stylesheet" href="{{asset('admin/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/admin.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-grid.min.css')}}">



	<!-- Favicons -->
	<link rel="icon" type="image/png" href="{{asset('admin/icon/favicon-32x32.png" sizes="32x32')}}">
	<link rel="apple-touch-icon" href="{{asset('admin/icon/favicon-32x32.png')}}">

    <script src="{{ asset('admin/ckfinder/ckfinder.js') }}"></script>
    <script src="{{ asset('admin/ckfinder/myscript.js') }}"></script>

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>FlixTV – Movies & TV Shows, Online cinema HTML Template</title>


</head>
<body>
	<!-- header -->
    @include('admin.widgets.header')
	<!-- end header -->

	<!-- sidebar -->
    @include('admin.widgets.sidebar')
	<!-- end sidebar -->

	<!-- main content -->
	<main class="main">
		<div class="container-fluid">
            @yield('body')
		</div>
	</main>
	<!-- end main content -->

	<!-- JS -->
    @include('admin.widgets.script')
    <!-- end JS -->
</body>
</html>
