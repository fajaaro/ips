@extends('backend.layouts.app')

@push('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous">

	<style>
		.close-card,
		.open-card {
			cursor: pointer;
		}

		.bundle-order {
			display: none;
		}
	</style>
@endpush

@section('content')
	@include('flash')
	
	<div class="orders-container">
		<div class="row justify-content-center">
	        <div class="col-12">
	            <div class="card">
	                <div class="card-header close-card" id="header-single-order">
	                	<span>Edit Order</span>
	                	<span class="float-right icon-action"><i class="fas fa-times" id="icon-single-order"></i></span>
	                </div>

	                <div class="card-body single-order">
	                	<form action="{{ route('backend.orders.update', ['id' => $order->id]) }}" method="post">
	                		@method('put')
	                		@csrf

	                		<input type="hidden" name="from" value="admin">
	                		<input type="hidden" name="order_type" value="{{ $order->course_id ? 'single' : 'bundle' }}">

	                		<div class="row mt-2">
					            <div class="col-md-6">
					                <label for="user"><span class="star">*</span> User</label>
					                <input type="text" id="user" class="form-control" name="user_id" value="{{ $order->user->first_name }} {{ $order->user->last_name }}" required disabled>
					            </div>
					            <div class="col-md-6">
					                <label for="course"><span class="star">*</span> {{ $order->course_id ? 'Course' : 'Bundle Category' }}</label>
					                <input type="text" id="course" class="form-control" name="{{ $order->course_id ? 'course_id' : 'bundle_id' }}" value="{{ $order->course->name ?? $order->bundle->name }}" required disabled>
					            </div>
					        </div>

					        <div class="row mt-2">
					            <div class="col">
					            	@if ($order->payment_status == 'paid')
						                <label for="payment-status"><span class="star">*</span> Payment Status</label>
						                <input type="text" id="payment-status" class="form-control" name="payment_status" value="{{ ucfirst($order->payment_status) }}" required disabled>
						            @else
						                <label for="payment-status"><span class="star">*</span> Payment Status</label>
						                <select id="payment-status" class="form-control" name="payment_status" required>
					                    	<option value="paid">Paid</option>
					                    	<option value="unpaid" selected>Unpaid</option>
						                </select>						            
					            	@endif
					            </div>
					        </div>    

					        <hr>

					        <div class="row mt-3">
					        	<div class="col">
					        		<button type="submit" class="btn btn-primary">Update</button>
				                    <a href="{{ url()->previous() }}">
				                        <button type="button" class="btn btn-outline-secondary float-right"><i class="fas fa-arrow-left"></i> Go Back</button>
				                    </a>
					        	</div>
					        </div>
					    </form>
	                </div>
	            </div>
	        </div>
	    </div>	
	</div>
	
@endsection

@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>

	<script>
		$(document).ready(function() {
			@if ($order->payment_status == 'unpaid')
				$('#payment-status').selectize({})
			@endif

			let arrowDownIconClass = 'fas fa-arrow-down'
			let closeIconClass = 'fas fa-times'

			$('.orders-container').on('click', '.close-card', function() {
				$(this).next().slideUp()

				$('#icon-single-order').removeClass().addClass(arrowDownIconClass)

				$(this).removeClass('close-card').addClass('open-card')
			})

			$('.orders-container').on('click', '.open-card', function() {
				$(this).next().slideDown()

				$('#icon-single-order').removeClass().addClass(closeIconClass)					

				$(this).removeClass('open-card').addClass('close-card')
			})

			$('#bundle-category').on('change', function() {
				$('.course-names').empty()

				let bundleId = $(this).val()

				axios
					.get(`/api/courses/bundle/${bundleId}`)
					.then(response => {
						let courses = response.data.courses

						let totalCourse = courses.length
						for (let i = 0; i < totalCourse; i++) {
							let courseNameElement = `<p>${courses[i].name}</p>`

							$('.course-names').append(courseNameElement)
						}

						$('.bundle-total-price').text(formatRupiah(response.data.price))
						$('.bundle-total-course').text(totalCourse)
					})
			})

			function formatRupiah(number){
				var	numberString = number.toString(),
					sisa 	= numberString.length % 3,
					rupiah 	= numberString.substr(0, sisa),
					ribuan 	= numberString.substr(sisa).match(/\d{3}/g);
						
				if (ribuan) {
					separator = sisa ? '.' : '';
					rupiah += separator + ribuan.join('.');
				}

				return `Rp${rupiah},00`
			}
		})
	</script>
@endpush
