@extends('backend.layouts.app')

@push('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css"/>
@endpush

@section('content')
	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Add New Course</div>

                <div class="card-body">
                	<form action="{{ route('backend.course-categories.update', ['id' => $category->id]) }}" method="post">
                		@csrf
                		@method('put')

				        <div class="row">
				            <div class="col">
				                <label for="name"><span class="star">*</span> Category Name</label>
				                <input type="text" id="name" class="form-control" name="name" placeholder="Input Category Name" value="{{ $category->name }}" required>
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
