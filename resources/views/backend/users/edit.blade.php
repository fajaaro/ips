@extends('backend.layouts.app')

@push('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous">
@endpush

@section('content')
	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                	<form action="{{ route('backend.users.update', ['id' => $user->id]) }}" method="post">
                		@csrf
                		@method('put')

                		@if (Auth::user()->inRole('root'))
                			<div class="row mb-2">
                				<div class="col">
                					<label for="role"><span class="star">*</span> Role</label>
                					<select id="role" class="form-control" name="role_id" required>
                						<option value="{{ $user->role->id }}">{{ ucfirst($user->role->name) }}</option>

                						@foreach ($roles as $role)
                							@if ($loop->iteration != $user->role->id)
	                							<option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                							@endif
                						@endforeach
                					</select>
                				</div>
                			</div>
                		@else
	                		<input type="hidden" name="role_id" value="3">
                		@endif

				        <div class="row">
				            <div class="col-md-6">
				                <label for="name"><span class="star">*</span> First Name</label>
				                <input type="text" id="name" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
				            </div>
				            <div class="col-md-6">
				                <label for="name">Last Name</label>
				                <input type="text" id="name" class="form-control" name="last_name" value="{{ $user->last_name }}">
				            </div>
				        </div>
				        <div class="row mt-2">
				            <div class="col-md-6">
				                <label for="email"><span class="star">*</span> Email</label>
				                <input type="email" id="email" class="form-control" name="email" value="{{ $user->email }}" disabled required>       
				            </div>
				            <div class="col-md-6">
				                <label for="phone"><span class="star">*</span> Phone Number</label>
				                <input type="text" id="phone" class="form-control" name="phone_number" placeholder="+62" value="{{ $user->phone_number }}" required>
				            </div>
				        </div>

				        <div class="row mt-2">
				        	<div class="col">
				        		<label for="password">Password</label>
				        		<input type="password" id="password" class="form-control" name="password">
				        	</div>
				        </div>
				        
				        <hr>
				        
				        <div class="row">
				            <div class="col">
				                <label for="address"><span class="star">*</span> Address</label>
				                <textarea id="address" class="form-control" name="address" rows="2" required>{{ $user->userAddress->address ?? '' }}</textarea>
				            </div>
				        </div>

				        <div class="row mt-2">
				            <div class="col">
				                <label for="city"><span class="star">*</span> City</label>
				                <select id="city" class="form-control" name="subdistrict_id" required>
				                	@if ($user->userAddress)
				                		<option value="{{ $user->userAddress->subdistrict_id }}">
				                			{{ $user->userAddress->subdistrict->kelurahan }}, {{ $user->userAddress->subdistrict->kecamatan }}, {{ $user->userAddress->subdistrict->city }}
				                		</option>
				                	@else
					                    <option value="">Select City</option>
				                	@endif
				                    
				                    @foreach ($subdistricts as $subdistrict)
				                    	<option value="{{ $subdistrict->id }}">{{ $subdistrict->kelurahan }}, {{ $subdistrict->kecamatan }}, {{ $subdistrict->city }}</option>
				                    @endforeach				                    
				                </select>
				            </div>
				        </div>        

				        <div class="row mt-2">
				            <div class="col-md-6">
				                <label for="province"><span class="star">*</span> Province</label>
				                <input type="text" id="province" class="form-control" name="province" value="{{ $user->userAddress->subdistrict->province->name ?? '' }}" disabled required>
				            </div>
				            <div class="col-md-6">
				                <label for="postal_code"><span class="star">*</span> Postal Code</label>
				                <input type="text" id="postal_code" class="form-control" value="{{ $user->userAddress->subdistrict->postal_code ?? '' }}" disabled required>   
				            </div>
				        </div>

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

@endsection

@push('scripts')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$('select').selectize({
				// sortField: 'text'
			})

			$('#city').on('change', function() {
				const subdistrictId = $(this).val()

				axios
					.get(`/api/subdistricts/${subdistrictId}`)
					.then(response => {
						const subdistrict = response.data[0]

						$('#postal_code').val(subdistrict.postal_code)

						return subdistrict.province_code
					})
					.then(provinceCode => {
						axios
							.get(`/api/provinces/${provinceCode}`)
							.then(response => {
								const province = response.data[0]

								$('#province').val(province.name)
							})						
					})
			})
		})
	</script>
@endpush
