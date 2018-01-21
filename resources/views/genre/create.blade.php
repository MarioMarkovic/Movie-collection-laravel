@extends('layout.main')
@section('content')
<h1>Kreiraj žanr</h1>
<a class="btn btn-md btn-info" href="{{ route('genre.index') }}">Natrag</a><br><br>
{!! Form::open(['route' => 'genre.store', 'method' => 'POST']) !!}
	<div class="form-group">
    	<?php echo Form::label('name', 'Ime:'); ?>
    	<?php echo Form::text('name', "", ['class' => 'form-control', 'placeholder' => 'Ime žanra', 'id' => 'name', 'required' => 'required']); ?>
    	@if($errors->has('name'))
            @foreach($errors->get('name') as $error)
                <small class="help-text text-danger">{{ $error }}</small>
            @endforeach
        @endif
	</div>
	<?php echo Form::submit('Kreiraj', ['class' => 'btn btn-md btn-primary']); ?>
{!! Form::close() !!}

@endsection
