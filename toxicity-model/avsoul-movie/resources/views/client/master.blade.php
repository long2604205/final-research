<!DOCTYPE html>
<html lang="en">
<head>
    @include('client.widgets.head')
</head>

<body>
	<!-- header (hidden style) -->
    @include('client.widgets.header')
	<!-- end header -->

    <!-- header (hidden style) -->
    @yield('main')
    <!-- end header -->

	<!-- footer -->
    @include('client.widgets.footer')
	<!-- end footer -->

	<!-- JS -->
    @include('client.widgets.script')
</body>
</html>
