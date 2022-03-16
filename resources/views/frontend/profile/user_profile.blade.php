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
                        <h3 class="text-center"> <span class="text-danger">Hi...</span> {{$user->name}} Update Your Profile</h3>

                        <div class="card-body">
                            <form action="{{route('user.profile.store')}}" method="post" enctype="multipart/form-data">
                             @csrf
                            
                            <div class="form-group">
                                <label class="info-title" for="name">Name <span>*</span></label>
                                <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control unicase-form-control text-input">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="email">Email <span>*</span></label>
                                <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control unicase-form-control text-input">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="info-title" for="phone">Phone <span>*</span></label>
                                <input type="phone" name="phone" id="phone" value="{{$user->phone}}" class="form-control unicase-form-control text-input">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="info-title" for="profile_photo_path">User Image <span>*</span></label>
                                
                                <input type="file" name="profile_photo_path" class="form-control" id="profile_photo_path"> 
                                @error('profile_photo_path')
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
