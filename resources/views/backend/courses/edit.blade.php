@extends('backend.layouts.app')

@push('styles')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous">
	<link href="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css"/>
	<style>
		@if ($course->image)
			#preview-image {
				width: 500px;
				height: 500px;
			}
		@endif
	</style>
@endpush

@section('content')
	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Edit Course</div>

                <div class="card-body">
                	<form action="{{ route('backend.courses.update', ['id' => $course->id]) }}" method="post" enctype="multipart/form-data">
                		@csrf
                		@method('put')

				        <div class="row">
				            <div class="col">
				                <label for="name"><span class="star">*</span> Course Name</label>
				                <input type="text" id="name" class="form-control" name="name" value="{{ $course->name }}" required>
				            </div>
				        </div>

                		<div class="row mt-2">
				            <div class="col-md-6">
				                <label for="category">Category</label>
				                <select id="category" class="form-control" name="category_id">
				                    <option value="">Choose Course Category</option>
				                    
				                    @foreach ($categories as $category)
				                    	<option value="{{ $category->id }}">{{ $category->name }}</option>
				                    @endforeach				                    
				                </select>
				            </div>
				            <div class="col-md-6">
				            	<label for="bundles"><span class="star">*</span> Bundles</label>
				            	<select id="bundles" class="form-control" name="bundles_id[]">
				            		<option value="">Choose Bundles Category</option>

				            		@foreach ($bundles as $bundle)
				            			<option value="{{ $bundle->id }}">{{ $bundle->name }}</option>
				            		@endforeach
				            	</select>
				            </div>
				        </div>    

				        <label for="overview" class="mt-2">Overview</label>
				        <textarea class="form-control" name="overview">{!! $course->overview !!}</textarea>

				        <label for="tools" class="mt-2">Tools</label>
				        <textarea class="form-control" name="tools">{!! $course->tools !!}</textarea>

				        <label for="recipes" class="mt-2">Recipes</label>
				        <textarea class="form-control" name="recipes">{!! $course->recipes !!}</textarea>

				        <label for="steps" class="mt-2">Steps</label>
				        <textarea class="form-control" name="steps">{!! $course->steps !!}</textarea>

				        <label for="notes" class="mt-2">Notes</label>
				        <textarea class="form-control" name="notes">{!! $course->notes !!}</textarea>

				        {{-- <label for="overview" class="mt-2">Overview</label>
				        <div id="overview">
				        	{!! $course->overview !!}
				        </div>
				        <input type="hidden" name="overview" class="input-overview">

				        <label for="tools" class="mt-2">Tools</label>
				        <div id="tools">
				        	{!! $course->tools !!}
				        </div>
				        <input type="hidden" name="tools" class="input-tools">

				        <label for="recipes" class="mt-2">Recipes</label>
				        <div id="recipes">
				        	{!! $course->recipes !!}
				        </div>
				        <input type="hidden" name="recipes" class="input-recipes">

				        <label for="steps" class="mt-2">Steps</label>
				        <div id="steps">
				        	{!! $course->steps !!}
				        </div>
				        <input type="hidden" name="steps" class="input-steps">

				        <label for="notes" class="mt-2">Notes</label>
				        <div id="notes">
				        	{!! $course->notes !!}
				        </div>
				        <input type="hidden" name="notes" class="input-notes"> --}}

				        <div class="row mt-2">
				            <div class="col-md-6">
				                <label for="course_video_url"><span class="star">*</span> Course Video URL</label>
				                <input type="text" id="course_video_url" class="form-control" name="course_video_url" value="{{ $course->courseVideo->url }}" required>
				            </div>
				            <div class="col-md-6">
				                <label for="price"><span class="star">*</span> Price</label>
				                <input type="number" id="price" class="form-control" name="price" value="{{ (int)$course->price }}" required>
				            </div>
				        </div>

				        <div class="row mt-2">
				        	<div class="col">
				                <label for="image">Image</label>
				                <input type="file" id="image" class="form-control-file" name="image">

				                <img src="{{ $course->image ? Storage::url($course->image->url) : '' }}" id="preview-image" class="mt-2">
				        	</div>
				        </div>

				        <hr>

				        <div class="row mt-3">
				        	<div class="col">
				        		<button type="submit" class="btn btn-primary">Update</button>
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
	{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@3.1.0/js/froala_editor.pkgd.min.js"></script>

	<script>
		$(document).ready(function() {
			createFroalaEditor('overviewEditor', 'overview', "Write course's overview...", 'input-overview')
			createFroalaEditor('toolsEditor', 'tools', "Write course's tools...", 'input-tools')
			createFroalaEditor('recipesEditor', 'recipes', "Write course's recipes...", 'input-recipes')
			createFroalaEditor('stepsEditor', 'steps', "Write course's steps...", 'input-steps')
			createFroalaEditor('notesEditor', 'notes', "Write course's notes...", 'input-notes')

			function createFroalaEditor(froalaEditorName, elementID, placeholder, elementInputClassName) {
				var froalaEditorName = new FroalaEditor(`#${elementID}`, {
					placeholderText: placeholder,
					events: {
						'charCounter.update': function () {
							let froalaText = froalaEditorName.html.get()

							$(`.${elementInputClassName}`).val(froalaText)
						},
						'html.set': function(html) {
							let froalaText = froalaEditorName.html.get()

							$(`.${elementInputClassName}`).val(froalaText)
						}
					}
				})				
			}

			
		})
	</script> --}}

	<script src="https://cdn.tiny.cloud/1/z7ech7bo4l8gldmxxrgfq3yuzp0cwtoegi5qaayqxilo0fir/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
	<script>
		$(document).ready(function() {
			let category = $('#category').selectize()

			let bundles = $('#bundles').selectize({
				maxItems: 25,
			})

			axios
				.get('/api/courses/{{ $course->id }}')
				.then(response => {
					const course = response.data
					const courseCategory = course.category
					const courseBundles = course.bundles

					const totalBundles = courseBundles.length
					let courseBundlesId = [];
					for (let i = 0; i < totalBundles; i++) {
						courseBundlesId.push(courseBundles[i].id)
					}

					category[0].selectize.setValue(courseCategory.id)
					bundles[0].selectize.setValue(courseBundlesId)
				})

			tinymce.init({
				selector: 'textarea',
				plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker image',
				toolbar: 'a11ycheck addcomment showcomments casechange checklist code formatpainter pageembed permanentpen table link image',
				toolbar_mode: 'floating',
				tinycomments_mode: 'embedded',
				tinycomments_author: 'Author name',
				a11y_advanced_options: true
			})

			$('#image').on('change', function(event) {
				var previewImage = document.getElementById('preview-image')
			    previewImage.src = URL.createObjectURL(event.target.files[0])
			    previewImage.onload = function() {
				    URL.revokeObjectURL(previewImage.src) 
			    }

			    $('#preview-image').css({
			    	'width': '500px',
			    	'height': '500px',			    	
			    })
			})			
		})
	</script>
@endpush
