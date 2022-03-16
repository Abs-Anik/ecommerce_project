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
                        <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                        <a href="{{route('user.profile')}}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                        <a href="{{route('user.password.change')}}" class="btn btn-primary btn-sm btn-block">Change Password</a>
                        <a href="{{route('user.logout')}}" class="btn btn-danger btn-sm btn-block">Logout</a>
                    </ul>
                </div>
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <div class="card">
                        <h3 class="text-center"> <span class="text-danger">Hi...</span> {{Auth::user()->name}} Welcome to Ecommerce Shop</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
