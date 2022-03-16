@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-2 mb-2">
                    <br><br>
                    <img class="card-img-top" style="border-radius: 50%;" src="{{(!empty($user->profile_photo_path))?url('upload/user_images/'.$user->profile_photo_path):url('upload/no_image.jpg')}}" alt="User Avatar" width="100%" height="100%">
                    <br><br>
                    <ul class="list-group list-group-flush">
                        <a href="{{route('dashboard')}}" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="{{route('user.password.change')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <h3 class="text-center"> <span class="text-danger">Change Your Password</span> </h3>

                        <div class="card-body">
                            <form action="{{route('user.password.store')}}" method="post" enctype="multipart/form-data">
                             @csrf
                            
                            <div class="form-group">
                                <label class="info-title" for="current_password">Current Password <span>*</span></label>
                                <input type="password" name="oldpassword" id="current_password" class="form-control unicase-form-control text-input">
                                @error('oldpassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password">New Password <span>*</span></label>
                                <input type="password" name="password" id="password" class="form-control unicase-form-control text-input">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="password_confirmation">Confirm Password <span>*</span></label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control unicase-form-control text-input">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-danger">Update</button>
                            </div>

                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
