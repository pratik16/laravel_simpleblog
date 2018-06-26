
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
			@if(empty($user->id))
				Create User
			@else
				Edit post {{ $user->name }}
			@endif
		</div>
	</div>
	<div class="panel-body">
		@if($user->count() == 0)
			<form action="{{ route('user.store')}}" method="post" enctype="multipart/form-data">
		@else 
			<form action="{{ route('user.store', ['id' => $user->id])}}" method="post" enctype="multipart/form-data">
		@endif
			{{ csrf_field() }}
			<div class="form-group">
				<label for="title">Name</label>
				<input type="text" name="name" class="form-control" value="{{ $user->name }}">
			</div>

			<div class="form-group">
				<label for="title">Email</label>
				<input type="email" name="email" class="form-control" value="{{ $user->email }}">
			</div>
			<div class="form-group">
				<label for="title">New password</label>
				<input type="password" name="password" class="form-control" value="{{ $user->password }}">
			</div>

			<div class="form-group">
				<label for="avatar">Profile picture</label>
				<input type="file" name="avatar" class="form-control">
			</div>
			<div class="form-group">
				<label for="about">About</label>
				<textarea name="about" id="about" cols="5" rows="10" class="form-control">{{$user->profile->about}}</textarea>
			</div>
			<div class="form-group">
				<label for="facebook">Facebook</label>
				<input type="text" name="facebook" class="form-control" value="{{ $user->profile->facebook }}">
			</div>
			<div class="form-group">
				<label for="youtube">Youtube</label>
				<input type="text" name="youtube" class="form-control" value="{{ $user->profile->youtube }}">
			</div>
			

			<div class="form-group">
				<div class="text-center">
					<button class="btn btn-success" type="submit">
						Save
					</button>
				</div>
			</div>
		</form>
	</div>

@stop