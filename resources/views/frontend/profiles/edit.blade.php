@extends('frontend.layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('frontend/style/main.css') }}">
@endpush

@section('navbar')
    @include('frontend.partials.navbar')
@endsection

@section('content')
    <div class="container profile-edit text-center mr-auto ml-auto mt-5">
        <h1 class="text-left font-weight-bold">Edit Profile</h1>
        <form action="{{ route('frontend.profiles.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <h2 class="text-left font-weight-bold">Profile</h2>
            
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group text-left">
                        <label for="namaDepanSiswa" class="font-weight-normal">First Name <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="namaDepanSiswa" name="first_name" aria-describedby="namaDepanSiswa" value="{{ $user->first_name }}" required>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-12">
                    <div class="form-group text-left">
                        <label for="namaBlkngSiswa" class="font-weight-normal">Last Name</label>
                        <input type="text" class="form-control" id="namaBlkngSiswa" name="last_name" aria-describedby="namaBlkngSiswa" value="{{ $user->last_name ?? '' }}">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group text-left">
                        <label for="emailSiswa" class="font-weight-normal">Email <span style="color:red">*</span></label>
                        <input type="text" class="form-control" id="emailSiswa" name="email" placeholder="{{ $user->email }}" aria-describedby="emailSiswa" readonly>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="form-group text-left password-section">
                        <label for="change-password" class="font-weight-normal">Password</label>
                        <button type="button" class="btn btn-change-pwd w-100" data-toggle="modal" data-target="#modalChangePassword" id="change-password">Change Password</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="form-group text-left">
                        <label for="exampleFormControlFile1">Profile Image</label>
                        <input type="file" class="form-control-file" name="avatar" id="exampleFormControlFile1">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group text-left custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" name="newsletter" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">I want to join Indonesia Patisserie School Newsletter</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-right">
                    <button type="submit" class="btn btn-back ">Back</button>
                    <button type="submit" class="btn btn-save ">Save</button>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modalChangePassword" tabindex="-1" role="dialog" aria-labelledby="modalChangePasswordLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalChangePasswordLabel">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('frontend.profiles.changePassword') }}" method="post">
                        @csrf
                        @method('put')

                        <div class="form-group text-left">
                            <label for="" class="font-weight-normal">Current Password<span style="color:red">*</span></label>
                            <div class="input-container">
                                <input type="password" class="form-control" id="current_password" name="current_password" required>
                                <i class="fas fa-eye togglePassword"></i>
                            </div>
                        </div>
                        <div class="form-group text-left">
                            <label for="" class="font-weight-normal">New Password<span style="color:red">*</span></label>
                            <div class="input-container">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <i class="fas fa-eye togglePassword"></i>
                            </div>
                        </div>
                        <div class="form-group text-left">
                            <label for="" class="font-weight-normal">New Password Confirmation<span style="color:red">*</span></label>
                            <div class="input-container">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                <i class="fas fa-eye togglePassword"></i>
                            </div>
                        </div>                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary shadow-none" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary shadow-none" id="buttonFormChangePassword">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('footer')
    @include('frontend.partials.footer', ['bgColor' => '#ffffff', 'useHr' => true, 'useLogo' => true, 'columnSize' => 'col-lg-3'])
@endsection

@push('scripts')
    <script src="https://kit.fontawesome.com/7e8b6ee2c8.js" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/js/password.js') }}"></script>
@endpush