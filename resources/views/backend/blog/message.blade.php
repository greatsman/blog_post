@if(session('message'))
	<div class="alert alert-info">
		{{ session('message') }}
	</div>
@elseif(session('trash-message'))
	<div class="alert alert-info">
		<?php list($message, $postId) = session('trash-message') ?>
		{{ $message }}
		{!! Form::open(['method'=>'PUT', 'route' => ['backend.blog.restore', $postId]]) !!}
			<button type="submit">Undo</button>
		{!! Form::close() !!}
	</div>
@endif