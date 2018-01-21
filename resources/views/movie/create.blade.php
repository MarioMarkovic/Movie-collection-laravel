@extends('layout.main')

@section('content')
	<h1>Unesite novi film</h1>
	{!! Form::open(['route' => 'movie.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
	<div class="form-group">
    	<?php echo Form::label('title', 'Naziv filma:'); ?>
    	<?php echo Form::text('title', "", ['class' => 'form-control', 'placeholder' =>'Naziv', 'id' => 'title', 'required' => 'required']); ?>
    	@if($errors->has('title'))
            @foreach($errors->get('title') as $error)
                <small class="help-text text-danger">{{ $error }}</small>
            @endforeach
        @endif
	</div>
	<div class="form-group">
		<?php echo Form::label('genre_id', 'Odaberite žanr:'); ?>
		<?php echo Form::select('genre_id', $select , null, ['placeholder' => '--', 'class' => 'form-control', 'id' => 'genre_id', 'required' => 'required']); ?>
		@if($errors->has('genre_id'))
            @foreach($errors->get('genre_id') as $error)
                <small class="help-text text-danger">{{ $error }}</small>
            @endforeach
        @endif
	</div>
	<div class="form-group">
		<?php echo Form::label('year', 'Godina snimanja:'); ?>
		<?php echo Form::select('year', $yearSel, null, ['placeholder' => '--', 'class' => 'form-control', 'id' => 'year', 'required' => 'required']); ?>
		@if($errors->has('year'))
            @foreach($errors->get('year') as $error)
                <small class="help-text text-danger">{{ $error }}</small>
            @endforeach
        @endif
	</div>
	<div class="form-group">
		<?php echo Form::label('duration', 'Vrijeme trajanja:'); ?>
		<?php echo Form::number('duration', '', ['class' => 'form-control', 'id' => 'duration', 'min' => '2', 'max' => '1440', 'required' => 'required']); ?>
		@if($errors->has('duration'))
            @foreach($errors->get('duration') as $error)
                <small class="help-text text-danger">{{ $error }}</small>
            @endforeach
        @endif
	</div>
	<div class="form-group">
		<?php echo Form::label('image', 'Slika:'); ?>
		<?php echo Form::file('image', ['class' => 'form-control', 'required' => 'required']); ?>
		@if($errors->has('image'))
            @foreach($errors->get('image') as $error)
                <small class="help-text text-danger">{{ $error }}</small>
            @endforeach
        @endif
	</div>

	<?php echo Form::submit('Unesi', ['class' => 'btn btn-md btn-primary']); ?>
{!! Form::close() !!}
	
	<h2>Popis svih filmova</h2>
	<table class="table table-striped table-condensed">
		<thead>
			<tr>
				<th>Slika</th>
				<th>Naslov</th>
				<th>Godina</th>
				<th>Trajanje</th>
				<th>Žanr</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($movies as $movie)
				<tr>
					<td><img style="width: 200px" class="img-thumbnail" src="/storage/images/{{$movie->image}}"></td>
					<td><h4>{{ $movie->title }}</h4></td>
					<td>{{ $movie->year }}</td>
					<td>{{ $movie->duration }}</td>
					<td>{{ $movie->genre->name }}</td>
					<td>
						<a class="btn btn-md btn-info" href="{{ route('movie.edit', ['id' => $movie->id ]) }}">Uredi</a>
					</td>
					<td>
						{!! Form::open(['route' => [ 'movie.destroy', $movie->id ], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Dali ste sigurni da želite obrisati ovaj film?")']) !!}
						<?php echo Form::submit('Izbriši', ['class' => 'btn btn-md btn-danger']); ?>
						{!! Form::close() !!}
					</td>
				</tr>
			@endforeach
		</tbody>

@endsection