@extends('frontend.main_master')
@section('content')
    <div class="body-content">
        <div class="container">
            <div class="row">
                @include('frontend.common.user_sidebar')
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
