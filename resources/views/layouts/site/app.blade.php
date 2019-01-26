<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include('includes.site.head')
<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="{{ route('/') }}"><b>T</b>utorials <b>A</b>pp</a>
		</div>
    	@yield('content')
	</div>
    @include('includes.site.scripts')
</body>
</html>
