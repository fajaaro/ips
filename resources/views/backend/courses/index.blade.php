@extends('backend.layouts.app')

@section('content')

	@include('flash')

	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Courses</div>

                <div class="card-body table-responsive">
                    <table class="table mb-2" id="courses-table">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Category</th>
                                <th scope="col">Total Users</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($courses as $course)
                                <tr>
                                    <th scope="row" width="10">{{ $loop->iteration }}</th>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ formatRupiah($course->price) }}</td>
                                    <td>{!! $course->category ? $course->category->name : '<i>NULL</i>' !!}</td>
                                    <td>
                                        <span data-html="true" data-toggle="tooltip" data-placement="right" title="@foreach($course->users as $user) {{ '<span class="float-left">' . $user->first_name . ' ' . $user->last_name . '</span><br>' }} @endforeach">{{ $course->users()->count() }}
                                        </span>
                                    </td>
                                    <td>{{ formatDate($course->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('backend.courses.show', ['id' => $course->id]) }}">
                                            <span class="badge badge-info badge-action" data-toggle="tooltip" data-placement="top" title="Show Details">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                        </a>

                                        <a href="{{ route('backend.courses.edit', ['id' => $course->id]) }}">
                                            <span class="badge badge-warning badge-action" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </span>                                            
                                        </a>

                                        <span class="badge badge-danger badge-action remove-course" data-toggle="tooltip" data-placement="top" title="Remove"> 
                                            <i class="far fa-trash-alt"></i>
                                        </span>

                                        <form action="{{ route('backend.courses.destroy', ['id' => $course->id]) }}" class="d-none" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>                                  
                        	@endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('backend.courses.create') }}">
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
            $('#courses-table').DataTable()

            $('.remove-course').on('click', function() {
                $(this).next().submit()
            })
        })
    </script>

    <script src="{{ asset('js/my-datatables.js') }}"></script>
@endpush