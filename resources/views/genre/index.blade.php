@extends('layout.main')

@section('content')
	<h1>Žanrovi</h1>
	<div>
		<a href="{{ route('genre.create') }}" class="btn btn-md btn-primary">Kreiraj novi žanr</a><br><br>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Naziv žanra</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($genres as $genre)
				<tr>
					<td>{{ $genre->name }}</td>
					<td>
						<a class="btn btn-md btn-info" href="{{ route('genre.edit', ['id' => $genre->id ]) }}">Uredi</a>
					</td>
					<td>
						{!! Form::open(['route' => [ 'genre.destroy', $genre->id ], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Dali ste sigurni da želite obrisati žanr?")']) !!}
						<?php echo Form::submit('Izbriši', ['class' => 'btn btn-md btn-danger']); ?>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection