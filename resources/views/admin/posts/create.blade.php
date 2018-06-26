
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
			@if(empty($post->id))
				Create Post
			@else
				Edit post {{ $post->title }}
			@endif
		</div>
	</div>
	<div class="panel-body">
		@if($post->count() == 0)
			<form action="{{ route('post.store')}}" method="post" enctype="multipart/form-data">
		@else 
			<form action="{{ route('post.store', ['id' => $post->id])}}" method="post" enctype="multipart/form-data">
		@endif
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" name="title" class="form-control" value="{{ $post->title }}">
			</div>

			<div class="form-group">
				<label for="featured">Featured image</label>
				<input type="file" name="featured" class="form-control">
			</div>

			<div class="form-group">
				<lable for="category">Select a category</lable>
				<select name="category_id" id="category" class="form-control">
					@foreach($categories as $category)
					<?php	$selected = ''; ?>
						@if($post->category_id == $category->id)
						<?php	$selected = 'selected'; ?>
						@endif
							<option value="{{ $category->id }}" {{ $selected }}>{{ $category->name }}</option>
					@endforeach

				</select>
			</div>
			<div class="form-group">
				<label for="tags">Select tags</label>
				@foreach($tags as $tag)
					<div class="checkbox">
						<label><input type="checkbox" name="tags[]" value="{{ $tag->id }}"
							@if(in_array($tag->id, $tag_ids))
								checked
							@endif
						>{{ $tag->tag }}</label>		
					</div>
				@endforeach
			</div>
			
			<div class="form-group">
				<label for="featured">Content</label>
				<textarea name="content" id="content" cols="5" rows="10" class="form-control">{{ $post->content }}</textarea>
			</div>

			<div class="form-group">
				<div class="text-center">
					<button class="btn btn-success" type="submit">
						Save post
					</button>
				</div>
			</div>
		</form>
	</div>

@stop