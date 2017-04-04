<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	
	@yield('styles')

</head>
<body>

<div class="container">
	<h1>Layout h1</h1>
	@yield('content')
</div>

@yield('scripts')

</body>
</html>