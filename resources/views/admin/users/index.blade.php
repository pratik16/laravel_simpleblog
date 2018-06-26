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
			User list
		</div>
	</div>
	<div class="panel-body">
		<table style="width:100%">
				<tr>
					<th>
						User image
					</th>
					<th>
						Username
					</th>
					<th>
						Edit user
					</th>
					<th>
						Delete user
					</th>
				</tr>
				
				@foreach($users as $user)
					<tr>
						<td><img src="{{ asset($user->profile->avatar) }}" height="50px"></td>
						<td>
							{{ $user->name }}
						</td>
						<td>
							<a href="#">Edit</a>
						</td>
						<td>
							<a href="#">Delete</a>
						</td>
					</tr>
				@endforeach
		</table>
	</div>
@stop