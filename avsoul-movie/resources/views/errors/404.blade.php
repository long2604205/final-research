<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- CSS -->
	<link rel="stylesheet" href="{{asset('admin/css/bootstrap-reboot.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/bootstrap-grid.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/magnific-popup.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('admin/css/admin.css')}}">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="icon/favicon-32x32.png">

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>FlixTV – Movies & TV Shows, Online cinema HTML Template</title>

</head>
<body>
	<!-- page 404 -->
	<div class="page-404 section--bg" data-bg="{{asset('admin/img/bg.jpg')}}">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="page-404__wrap">
						<div class="page-404__content">
							<h1 class="page-404__title">404</h1>
							<p class="page-404__text">The page you are looking for not available!</p>
                            <a href="{{route('home')}}" class="page-404__btn">go back</a>
                            {{-- <a href="{{route('dashboard')}}" class="page-404__btn">go back</a> --}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end page 404 -->

	<!-- JS -->
	<script src="{{asset('admin/js/jquery-3.5.1.min.js')}}"></script>
	<script src="{{asset('admin/js/bootstrap.bundle.min.js')}}"></script>
	<script src="{{asset('admin/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('admin/js/smooth-scrollbar.js')}}"></script>
	<script src="{{asset('admin/js/select2.min.js')}}"></script>
	<script src="{{asset('admin/js/admin.js')}}"></script>
</body>
</html>
