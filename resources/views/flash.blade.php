@php
	if (session('success')) {
		$alertType = 'success';
		$message = session('success');
	} else if (session('failed')) {
		$alertType = 'danger';
		$message = session('failed');		
	}
@endphp

@if (session('success') || session('failed'))
	<div class="alert alert-{{ $alertType }} alert-dismissible fade show w-100" role="alert">
		<span>{{ $message }}</span>
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    <span aria-hidden="true">&times;</span>
		</button>
	</div>
@endif