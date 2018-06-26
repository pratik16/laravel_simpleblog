
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
			Create Category
		</div>
	</div>
	<div class="panel-body">
		@if(!empty($category->id))
			<form action="{{ route('category.update', ['id' => $category->id])}}" method="post">
		@else
			<form action="{{ route('category.store')}}" method="post">
		@endif
		
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">Name</label>
				<input type="text" name="name" value="{{ $category->name }}" class="form-control">
			</div>
			
			<div class="form-group">
				<div class="text-center">
					<button class="btn btn-success" type="submit">
						Save category
					</button>
				</div>
			</div>
		</form>
	</div>

@stop