
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
			Trashed post list
		</div>
	</div>
	<div class="panel-body">
		<table style="width:100%">
				<tr>
					<th>
						Post image
					</th>
					<th>
						Post title
					</th>
					<th>
						Edit post
					</th>
					<th>
						Restore post
					</th>
					<th>
						Permenantly remove
					</th>
				</tr>
				@foreach($posts as $post)
					<tr>
						<td><img src="{{ $post->featured }}" alt="{{ $post->title }}" height="50px"></td>
						<td>
							{{ $post->title }}
						</td>
						<td>
							<a href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
						</td>
						<td>
							<a href="{{ route('post.restore', ['id' => $post->id])}}">Restore</a>
						</td>
						<td>
							<a href="{{ route('post.remove', ['id' => $post->id]) }}">Remove from db</a>
						</td>
					</tr>
				@endforeach
		</table>
	</div>
@stop