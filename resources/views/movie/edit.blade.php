@extends('layout.main')

@section('content')

	<h1>Uredi film</h1>
	{!! Form::model($movie, ['route' => ['movie.update', $movie->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
	<div class="form-group">
    	<?php echo Form::label('title', 'Naziv filma:'); ?>
    	<?php echo Form::text('title', "$movie->title", ['class' => 'form-control', 'placeholder' =>'Naziv', 'id' => 'title', 'required' => 'required']); ?>
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
		<?php echo Form::number('duration', "$movie->duration", ['class' => 'form-control', 'id' => 'duration', 'min' => '2', 'max' => '1440', 'required' => 'required']); ?>
		@if($errors->has('duration'))
            @foreach($errors->get('duration') as $error)
                <small class="help-text text-danger">{{ $error }}</small>
            @endforeach
        @endif
	</div>
	<div class="form-group">
		<?php echo Form::label('image', 'Slika:'); ?>
		<?php echo Form::file('image', ['class' => 'form-control']); ?>
		@if($errors->has('image'))
            @foreach($errors->get('image') as $error)
                <small class="help-text text-danger">{{ $error }}</small>
            @endforeach
        @endif
        <img class="img-thumbnail" src="/storage/images/{{$movie->image}}">
	</div>

	<?php echo Form::submit('Unesi', ['class' => 'btn btn-md btn-primary']); ?>
	{!! Form::close() !!}
@endsection