<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Kolekcija filmova</title>
	<link rel="stylesheet" type="text/css" href="/css/app.css">
</head>
<body>
	<nav class="navbar navbar-inverse ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('movie.index') }}">Kolekcija filmova</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="{{ route('movie.index') }}">Filmovi</a></li>
            <li><a href="{{ route('movie.create') }}">Unos filmova</a></li>
            <li><a href="{{ route('genre.index') }}">Unos žanrova</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<div class="container">
    @if(session()->has('message'))
 			<div class="alert alert-success">
 				{{ session()->get('message') }}
 			</div>
    @endif
		@yield('content')
	</div>
</body>
</html>