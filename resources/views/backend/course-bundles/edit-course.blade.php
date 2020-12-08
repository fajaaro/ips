@extends('backend.layouts.app')

@push('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous">
@endpush

@section('content')
	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Bundle</div>

                <div class="card-body">
                	<form action="{{ route('backend.course-bundles.updateCourse', ['id' => $bundle->id]) }}" method="post">
                		@csrf

				        <div class="row">
				            <div class="col">
				                <label for="name"><span class="star">*</span> Bundle Name</label>
				                <input type="text" id="name" class="form-control" name="name" placeholder="Input Bundle Name" value="{{ $bundle->name }}" required disabled>
				            </div>
				        </div>  

				        <div class="row">
				        	<div class="col">
				        		<label for="courses">Courses</label>
				            	<select id="courses" class="form-control" name="courses_id[]">
				            		<option value="">Choose Course</option>

				            		@foreach ($courses as $course)
				            			<option value="{{ $course->id }}">{{ $course->name }}</option>
				            		@endforeach
				            	</select>
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
    		let courses = $('#courses').selectize({
				maxItems: 75,
			})

			axios
				.get('/api/courses/bundle/{{ $bundle->id }}')
				.then(response => {
					const bundleCourses = response.data.courses
					const totalBundleCourses = bundleCourses.length

					let bundleCoursesId = []
					for (let i = 0; i < totalBundleCourses; i++) {
						bundleCoursesId.push(bundleCourses[i].id)
					}
					courses[0].selectize.setValue(bundleCoursesId)	
				})
    	})
    </script>
@endpush