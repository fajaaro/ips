@extends('backend.layouts.app')

@push('styles')
	<style type="text/css">
		.role-column:first-letter {
	        text-transform: capitalize;
		}
	</style>
@endpush

@section('content')

	@include('flash')

	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Course Categories</div>

                <div class="card-body">
                    <table class="table mb-2" id="course-categories-table">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Total Course</th>
                                <th scope="col">Added At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                        	@foreach ($categories as $category)
                                <tr>
                                    <th scope="row" width="10">{{ $i++ }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <span data-html="true" data-toggle="tooltip" data-placement="right" title="@foreach($category->courses as $course) {{ '<span class="float-left">' . $course->name . '</span><br>' }} @endforeach">{{ $category->courses()->count() }}
                                        </span>
                                    </td>
                                    <td>{{ formatDate($category->created_at) }}</td>
                                    <td>
                                        <span class="badge badge-info badge-action" data-toggle="tooltip" data-placement="top" title="Show Details">
                                            <i class="fas fa-info-circle"></i>
                                        </span>

                                        <a href="{{ route('backend.courseCategories.edit', ['id' => $category->id]) }}">
                                            <span class="badge badge-warning badge-action" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </span>                                            
                                        </a>

                                        <span class="badge badge-danger badge-action" id="remove-category" data-toggle="tooltip" data-placement="top" title="Remove"> 
                                            <i class="far fa-trash-alt"></i>
                                        </span>

                                        <form action="{{ route('backend.courseCategories.destroy', ['id' => $category->id]) }}" class="d-none" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                        	@endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('backend.courseCategories.create') }}">
	                    <button type="button" class="btn btn-primary btn-sm">Add New</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#course-categories-table').DataTable()

            $('#remove-category').on('click', function() {
                $(this).next().submit()
            })
        })
    </script>
@endpush
