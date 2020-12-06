@extends('backend.layouts.app')

@section('content')

	@include('flash')

	<div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Course Details</div>

                <div class="card-body">
                    @if ($course->image)
                        <img src="{{ Storage::url($course->image->url) }}" class="w-100 mb-3">
                    @else 
                        <img src="{{ Storage::url('course-images/default.png') }}" class="w-100 mb-3">
                    @endif
                    
                    <div class="row">
                        <div class="col-md-5">
                            <p><span class="font-weight-bold">Name:</span> {{ $course->name }}</p>
                            <p><span class="font-weight-bold">Price:</span> {{ formatRupiah($course->price) }}</p>
                            
                            <p class="font-weight-bold">Overview:</p>
                            <div>{!! $course->overview !!}</div>
                            <p class="font-weight-bold">Recipes:</p>
                            <div>{!! $course->recipes !!}</div>
                            <p class="font-weight-bold">Steps:</p>
                            <div>{!! $course->steps !!}</div>
                            <p class="font-weight-bold">Notes:</p>
                            <div>{!! $course->notes !!}</div>
                            
                            <p><span class="font-weight-bold">Added At:</span> {{ formatDate($course->created_at) }}</p>
                            <p><span class="font-weight-bold">Last Update:</span> {{ formatDate($course->updated_at) }}</p>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                            <p><span class="font-weight-bold">Category:</span> {{ $course->category->name }}</p>
                            <p class="font-weight-bold">Bundles:</p>
                            <ul>
                                @foreach ($course->bundles as $bundle)
                                    <li>{{ $bundle->name }}</li>
                                @endforeach
                            </ul>

                            <p class="font-weight-bold">Video:</p>
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe class="embed-responsive-item" src="{{ $course->courseVideo->url }}"></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <a href="{{ route('backend.courses.edit', ['id' => $course->id]) }}">
        	                    <button type="button" class="btn btn-warning">Edit</button>
                            </a>
                            <a href="{{ url()->previous() }}">
                                <button type="button" class="btn btn-outline-secondary float-right"><i class="fas fa-arrow-left"></i> Go Back</button>
                            </a>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
