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
                <div class="card-header">Users</div>

                <div class="card-body">
                    <table class="table mb-2" id="users-table">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Role</th>
                                <th scope="col">Total Course</th>                                
                                <th scope="col">Registered At</th>
                                <th scope="col">Actions</th>                                
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($users as $user)
                                <tr>
                                    <th scope="row" width="10">{{ $loop->iteration }}</th>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td class="role-column">{{ $user->role_name }}</td>
                                    <td>
                                        <span data-html="true" data-toggle="tooltip" data-placement="right" title="@foreach($user->courses as $course) {{ '<span class="float-left">' . $course->name . '</span><br>' }} @endforeach">{{ $user->courses()->count() }}
                                        </span>
                                    </td>
                                    <td>{{ formatDate($user->created_at) }}</td>
                                    <td>
                                        <a href="{{ route('backend.users.show', ['id' => $user->id]) }}">
                                            <span class="badge badge-info badge-action" data-toggle="tooltip" data-placement="top" title="Show Details">
                                                <i class="fas fa-info-circle"></i>
                                            </span>                                            
                                        </a>

                                        <a href="{{ route('backend.users.edit', ['id' => $user->id]) }}">
                                            <span class="badge badge-warning badge-action" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </span>                                            
                                        </a>

                                        <span class="badge badge-danger badge-action remove-user" data-toggle="tooltip" data-placement="top" title="Remove"> 
                                            <i class="far fa-trash-alt"></i>
                                        </span>

                                        <form action="{{ route('backend.users.destroy', ['id' => $user->id]) }}" class="d-none" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                        	@endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('backend.users.create') }}">
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
            $('#users-table').DataTable()

            $('.remove-user').on('click', function() {
                $(this).next().submit()
            })
        })
    </script>
@endpush