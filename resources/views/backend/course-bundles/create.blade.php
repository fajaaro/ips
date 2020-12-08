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
                	<form action="{{ route('backend.course-bundles.store') }}" method="post">
                		@csrf

				        <div class="row">
				            <div class="col-7">
				                <label for="names"><span class="star">*</span> Bundle Name</label>
				                <input type="text" id="names" class="form-control" name="names[]" placeholder="Input Bundle Name" required>
				            </div>
				            <div class="col-4">
				                <label for="prices"><span class="star">*</span> Bundle Price</label>
				                <input type="number" id="prices" class="form-control" name="prices[]" placeholder="Input Bundle Price" required>
				            </div>
				            <div class="col-1 pt-4">
				            	<button type="button" class="btn btn-secondary mt-2 btn-add-name btn-add-first-row">+</button>
				            </div>
				        </div>  

				        <div class="row mt-3">
				        	<div class="col">
				        		<button type="submit" class="btn btn-primary">Submit</button>
				        	</div>
				        </div>
				    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
	<script>
		$(document).ready(function() {
			const element = `
				<div class="row mt-2">
		            <div class="col-7">
		                <input type="text" id="names" class="form-control" name="names[]" placeholder="Input Bundle Name" required>
		            </div>
		            <div class="col-4">
		                <input type="number" id="prices" class="form-control" name="prices[]" placeholder="Input Bundle Price" required>
		            </div>
		            <div class="col-1">
		            	<button type="button" class="btn btn-secondary btn-add-name">+</button>
		            </div>
		        </div> 
			`
			const label = `
                <label for="names"><span class="star">*</span> Category Name</label>
			`

			$('.card-body').on('click', '.btn-add-name', function() {
				$(this).removeClass('btn-secondary btn-add-name').addClass('btn-danger btn-remove-name')
				$(this).text('x')
				$(this).parent().parent().after(element)
			})

			$('.card-body').on('click', '.btn-remove-name', function() {
				if ($(this).hasClass('btn-add-first-row')) {
					$(this).parent().parent().next().children().first().prepend(label)
					$(this).parent().parent().next().children().last().addClass('pt-4')
					$(this).parent().parent().next().children().last().children().addClass('btn-add-first-row mt-2')
					$(this).parent().parent().remove()
				} else {
					$(this).parent().parent().remove()					
				}
			})
		})
	</script>
@endpush

