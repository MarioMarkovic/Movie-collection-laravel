@extends('layout.main')

@section('content')
	<h1>Uredi žanr</h1>
	<a href="{{ route('genre.index') }}" class="btn btn-md btn-primary">Natrag</a><br><br>
	{!! Form::open(['route' => ['genre.update', $genre->id], 'method' => 'POST']) !!}
		<div class="form-group">
	    	<?php echo Form::label('name', 'Ime:'); ?>
	    	<?php echo Form::text('name', old('name', $genre->name), ['class' => 'form-control', 'placeholder' => 'Ime žanra', 'id' => 'name', 'required' => 'required']); ?>
	    	@if($errors->has('name'))
	            @foreach($errors->get('name') as $error)
	                <small class="help-text text-danger">{{ $error }}</small>
	            @endforeach
	        @endif
		</div>
		<?php echo Form::submit('Spremi', ['class' => 'btn btn-md btn-primary']); ?>
	{!! Form::close() !!}
@endsection