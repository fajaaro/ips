@extends('backend.layouts.app')

@section('content')

	@include('flash')

	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Orders</div>

                <div class="card-body">
                    <table class="table mb-2" id="orders-table">
                        <thead>
                            <tr>
                                <th scope="col" width="10">#</th>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">User</th>
                                <th scope="col">Total Price</th>                                
                                <th scope="col">Payment Status</th>                                
                                <th scope="col">Order At</th>
                                <th scope="col">Expired At</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@foreach ($orders as $order)
                                <tr>
                                    <th scope="row" width="10">{{ $loop->iteration }}</th>
                                    <td>{{ $order->invoice_number }}</td>
                                    <td>{{ $order->course->name }}</td>
                                    <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                                    <td>{{ formatRupiah($order->total_price) }}</td>
                                    <td>
                                        @if ($order->payment_status == 'paid')
                                            <span class="text-success">Paid ({{ formatDate($order->paid_at) }})</span>
                                        @else
                                            <span class="text-danger">Unpaid</span>
                                        @endif
                                    </td>
                                    <td>{{ formatDate($order->created_at) }}</td>
                                    <td>
                                        @if ($order->payment_status == 'paid')
                                            <span>{{ formatDate($order->courseUser->expired_at) }}</span>
                                        @else
                                            <span><i>NULL</i></span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('backend.orders.show', ['id' => $order->id]) }}">
                                            <span class="badge badge-info badge-action" data-toggle="tooltip" data-placement="top" title="Show Details">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                        </a>

                                        <a href="{{ route('backend.orders.edit', ['id' => $order->id]) }}">
                                            <span class="badge badge-warning badge-action" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </span>                                            
                                        </a>

                                        <span class="badge badge-danger badge-action remove-order" data-toggle="tooltip" data-placement="top" title="Remove"> 
                                            <i class="far fa-trash-alt"></i>
                                        </span>

                                        <form action="{{ route('backend.orders.destroy', ['id' => $order->id]) }}" class="d-none" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </td>
                                </tr>
                        	@endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('backend.orders.create') }}">
	                    <button type="button" class="btn btn-primary btn-sm">Add New</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js" integrity="sha512-quHCp3WbBNkwLfYUMd+KwBAgpVukJu5MncuQaWXgCrfgcxCJAq/fo+oqrRKOj+UKEmyMCG3tb8RB63W+EmrOBg==" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('#orders-table').DataTable()

            $('.remove-order').on('click', function() {
                $(this).next().submit()
            })
        })
    </script>

    <script src="{{ asset('js/my-datatables.js') }}"></script>
@endpush