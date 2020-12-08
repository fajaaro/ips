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
                    <table class="table mb-2" id="course-bundles-table">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total Course</th>                                
                                <th scope="col">Total Sales</th>                                
                                <th scope="col">Added At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp

                        	@foreach ($bundles as $bundle)
                                <tr>
                                    <th scope="row" width="10">{{ $i++ }}</th>
                                    <td>{{ $bundle->name }}</td>
                                    <td>{{ formatRupiah($bundle->price) }}</td>
                                    <td>
                                        <span data-html="true" data-toggle="tooltip" data-placement="right" title="@foreach($bundle->courses as $course) {{ '<span class="float-left">' . $course->name . '</span><br>' }} @endforeach">{{ $bundle->courses()->count() }}
                                        </span>
                                    </td>
                                    <td>
                                        <span data-html="true" data-toggle="tooltip" data-placement="right" title="@foreach($bundle->orders as $order) {{ '<span class="float-left">' . $order->user->getFullName() . ' (' . formatDate($order->created_at) . ')' . '</span><br>' }} @endforeach">{{ $bundle->orders()->count() }}
                                        </span>
                                    </td>                                    
                                    <td>{{ formatDate($bundle->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('backend.course-bundles.editCourse', ['id' => $bundle->id]) }}">
                                            <span class="badge badge-primary badge-action" data-toggle="tooltip" data-placement="left" title="Edit Course In This Bundle">
                                                <i class="fa fa-plus"></i>
                                            </span>                                            
                                        </a>

                                        <a href="{{ route('backend.course-bundles.edit', ['id' => $bundle->id]) }}">
                                            <span class="badge badge-warning badge-action" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </span>                                            
                                        </a>

                                        <span class="badge badge-danger badge-action remove-bundle" data-toggle="tooltip" data-placement="top" title="Remove"> 
                                            <i class="far fa-trash-alt"></i>
                                        </span>

                                        <form action="{{ route('backend.course-bundles.destroy', ['id' => $bundle->id]) }}" class="d-none" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                        	@endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('backend.course-bundles.create') }}">
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
            $('#course-bundles-table').DataTable()

            $('#course-bundles-table').on('click', '.remove-bundle', function() {
                $(this).next().submit()
            })
        })
    </script>

    <script src="{{ asset('js/my-datatables.js') }}"></script>
@endpush
