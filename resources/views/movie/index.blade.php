@extends('layout.main')

@section('content')
	<h1>Popis svih filmova</h1><br>
	<?php
	$alphabet = range('A', 'Z');
	foreach($alphabet as $letter) {
		echo "<a class='search-links' href='$letter'>".$letter."</a>";
	}
	?>
	<br><br>	
	<div class="container movies-container">	
		<div class="row">
			<?php
			if(isset($movies)) {
				$mov = $movies; 
			}
			else if(isset($searchMovies) && count($searchMovies) > 0) {
				$mov = $searchMovies;
			} else {
				echo "<p class='alert alert-danger'>Nema pronađenih filmova!</p>"; 
			}
			?>
			@if(isset($mov)) 
			@foreach($mov as $movie)
			<div class="col-md-8">
				<h3>{{ $movie->title }} ({{ $movie->year }})</h3>
				<p class="lead">
					Trajanje: {{ $movie->duration }} <br>
					Žanr: {{ $movie->genre->name }}
				</p>
				<img class="img-responsive" src="storage/images/{{$movie->image}}">
			</div>
			@endforeach
			@endif
		</div>
	</div>
@endsection