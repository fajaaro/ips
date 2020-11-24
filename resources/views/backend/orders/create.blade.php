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
	
	<div class="orders-container">
		<div class="row justify-content-center">
	        <div class="col-12">
	            <div class="card">
	                <div class="card-header close-card" id="header-normal-order">
	                	<span>Add New Order</span>
	                	<span class="float-right icon-action"><i class="fas fa-times" id="icon-normal-order"></i></span>
	                </div>

	                <div class="card-body normal-order">
	                	<form action="{{ route('backend.orders.store') }}" method="post" enctype="multipart/form-data">
	                		@csrf

	                		<input type="hidden" name="from" value="admin">
	                		<input type="hidden" name="order_type" value="normal">

	                		<div class="row mt-2">
					            <div class="col-md-6">
					                <label for="user"><span class="star">*</span> User</label>
					                <select id="user" class="form-control" name="user_id" required>
					                    <option value="">Choose User</option>
					                    
					                    @foreach ($users as $user)
					                    	<option value="{{ $user->id }}">{{ $user->name }}</option>
					                    @endforeach				                    
					                </select>
					            </div>
					            <div class="col-md-6">
					                <label for="course"><span class="star">*</span> Course</label>
					                <select id="course" class="form-control" name="course_id" required>
					                    <option value="">Choose Course</option>
					                    
					                    @foreach ($courses as $course)
					                    	<option value="{{ $course->id }}">{{ $course->name }}</option>
					                    @endforeach				                    
					                </select>
					            </div>
					        </div>

					        <div class="row mt-2">
					            <div class="col">
					                <label for="payment-status"><span class="star">*</span> Payment Status</label>
					                <select id="payment-status" class="form-control" name="payment_status" required>
					                    <option value="">Choose Payment Status</option>
				                    	<option value="paid">Paid</option>
				                    	<option value="unpaid">Unpaid</option>
					                </select>
					            </div>
					        </div>    

					        <hr>

					        <div class="row mt-3">
					        	<div class="col">
					        		<button type="submit" class="btn btn-primary">Submit</button>
				                    <a href="{{ route('backend.orders.index') }}">
				                        <button type="button" class="btn btn-outline-secondary float-right"><i class="fas fa-arrow-left"></i> Go Back</button>
				                    </a>
					        	</div>
					        </div>
					    </form>
	                </div>
	            </div>
	        </div>
	    </div>

	    <div class="row justify-content-center mt-3">
	        <div class="col-12">
	            <div class="card">
	                <div class="card-header open-card" id="header-bundle-order">
	                	<span>Add New Order (Bundle)</span>
	                	<span class="float-right icon-action"><i class="fas fa-arrow-down" id="icon-bundle-order"></i></span>
	                </div>

	                <div class="card-body bundle-order">
	                	<form action="{{ route('backend.orders.store') }}" method="post" enctype="multipart/form-data">
	                		@csrf

	                		<input type="hidden" name="from" value="admin">
	                		<input type="hidden" name="order_type" value="bundle">

	                		<div class="row mt-2">
					            <div class="col-md-6">
					                <label for="user"><span class="star">*</span> User</label>
					                <select id="bundle-user" class="form-control" name="user_id" required>
					                    <option value="">Choose User</option>
					                    
					                    @foreach ($users as $user)
					                    	<option value="{{ $user->id }}">{{ $user->name }}</option>
					                    @endforeach				                    
					                </select>
					            </div>
					            <div class="col-md-6">
					                <label for="course"><span class="star">*</span> Course Category</label>
					                <select id="bundle-category" class="form-control" name="course_category_id" required>
					                    <option value="">Choose Bundle Category</option>
					                    
					                    @foreach ($bundleCourseCategories as $category)
					                    	<option value="{{ $category->id }}">{{ $category->name }}</option>
					                    @endforeach				                    
					                </select>
					            </div>
					        </div>

					        <div class="row mt-2">
					            <div class="col">
					                <label for="payment-status"><span class="star">*</span> Payment Status</label>
					                <select id="bundle-payment-status" class="form-control" name="payment_status" required>
					                    <option value="">Choose Payment Status</option>
				                    	<option value="paid">Paid</option>
				                    	<option value="unpaid">Unpaid</option>
					                </select>
					            </div>
					        </div>    

					        <hr>

					        <div class="row">
					        	<div class="col-8">
					        		<p class="font-weight-bold">Course Name</p>
					        	</div>
					        	<div class="col-4">
					        		<p class="font-weight-bold">Price</p>
					        	</div>

					        	<div class="col-8 course-names">
					        	</div>
					        	<div class="col-4 course-prices">
					        	</div>
					        </div>

					        <hr class="mt-0">

					        <div class="row">
					        	<div class="col-8">
					        		<p class="font-weight-bold">Total Price</p>
					        	</div>
					        	<div class="col-4">
					        		<p class="font-weight-bold bundle-total-price"></p>
					        	</div>
					        </div>

					        <div class="row mt-3">
					        	<div class="col">
					        		<button type="submit" class="btn btn-primary">Submit</button>
				                    <a href="{{ route('backend.orders.index') }}">
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
			$('#user').selectize({})
			$('#course').selectize({})
			$('#payment-status').selectize({})

			$('#bundle-user').selectize({})
			$('#bundle-category').selectize({})
			$('#bundle-payment-status').selectize({})

			let arrowDownIconClass = 'fas fa-arrow-down'
			let closeIconClass = 'fas fa-times'

			$('.orders-container').on('click', '.close-card', function() {
				$(this).next().slideUp()

				if ($(this).attr('id') == 'header-normal-order') {
					$('#icon-normal-order').removeClass().addClass(arrowDownIconClass)
				} else {
					$('#icon-bundle-order').removeClass().addClass(arrowDownIconClass)					
				}

				$(this).removeClass('close-card').addClass('open-card')
			})

			$('.orders-container').on('click', '.open-card', function() {
				$(this).next().slideDown()

				if ($(this).attr('id') == 'header-normal-order') {
					$('#icon-normal-order').removeClass().addClass(closeIconClass)					

					$('.bundle-order').slideUp()
					$('#icon-bundle-order').removeClass().addClass(arrowDownIconClass)

					$('#header-bundle-order').removeClass('close-card').addClass('open-card')
				} else {
					$('#icon-bundle-order').removeClass().addClass(closeIconClass)					

					$('.normal-order').slideUp()
					$('#icon-normal-order').removeClass().addClass(arrowDownIconClass)

					$('#header-normal-order').removeClass('close-card').addClass('open-card')
				}

				$(this).removeClass('open-card').addClass('close-card')
			})

			$('#bundle-category').on('change', function() {
				$('.course-names').empty()
				$('.course-prices').empty()

				let bundleCategoryId = $(this).val()

				axios
					.get(`/api/courses/bundle/${bundleCategoryId}`)
					.then(response => {
						let courses = response.data

						let totalCourses = courses.length
						let totalPrice = 0.00
						for (let i = 0; i < totalCourses; i++) {
							let coursePrice = parseInt(courses[i].price)

							let courseNameElement = `<p>${courses[i].name}</p>`
							let coursePriceElement = `<p>${formatRupiah(coursePrice)}</p>`

							$('.course-names').append(courseNameElement)
							$('.course-prices').append(coursePriceElement)

							totalPrice += coursePrice
						}

						$('.bundle-total-price').text(formatRupiah(totalPrice))
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
