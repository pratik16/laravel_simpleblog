
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
			Category list
		</div>
	</div>
	<div class="panel-body">
		<table style="width:100%">
				@foreach($categories as $category)
					<tr>
						<td>
							{{ $category->name }}
						</td>
						<td>
							<a href="{{ route('category.edit', ['id' => $category->id]) }}">Edit</a>
						</td>
						<td>
							<a href="{{ route('category.delete', ['id' => $category->id]) }}">Delete</a>
						</td>
					</tr>
				@endforeach
		</table>
	</div>
@stop