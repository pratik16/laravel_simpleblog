
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
			Post list
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
						Delete post
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
							<a href="{{ route('post.delete', ['id' => $post->id]) }}">Delete</a>
						</td>
					</tr>
				@endforeach
		</table>
	</div>
@stop