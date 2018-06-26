
@extends('layouts.app')

@section('content')

	@if(count($errors) > 0)
		<ul class="list-group">
			@foreach($errors->all() as $error)
				<li class="list-group-item text-danger">
					{{ $error }}
				</li>
			@endforeach
		</ul>
	@endif

	<div class="panel panel-default">
		<div class="panel-heading">
			Create Tag
		</div>
	</div>
	<div class="panel-body">
		@if(!empty($tag->id))
			<form action="{{ route('tag.update', ['id' => $tag->id])}}" method="post">
		@else
			<form action="{{ route('tag.store')}}" method="post">
		@endif
		
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">tag</label>
				<input type="text" name="tag" value="{{ $tag->tag }}" class="form-control">
			</div>
			
			<div class="form-group">
				<div class="text-center">
					<button class="btn btn-success" type="submit">
						Save tag
					</button>
				</div>
			</div>
		</form>
	</div>

@stop