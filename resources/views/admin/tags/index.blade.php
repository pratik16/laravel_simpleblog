
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
			Tag list
		</div>
	</div>
	<div class="panel-body">
		<table style="width:100%">
				@foreach($tags as $tag)
					<tr>
						<td>
							{{ $tag->tag }}
						</td>
						<td>
							<a href="{{ route('tag.edit', ['id' => $tag->id]) }}">Edit</a>
						</td>
						<td>
							<a href="{{ route('tag.delete', ['id' => $tag->id]) }}">Delete</a>
						</td>
					</tr>
				@endforeach
		</table>
	</div>
@stop