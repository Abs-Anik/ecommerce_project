@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
          
        <!-- /.col -->
        {{-- Add Brand --}}

        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Slider</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('slider.update', $slider->id)}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" name="id" value="{{$slider->id}}"> 
                    <input type="hidden" name="old_image" value="{{$slider->slider_img}}"> 
                                <div class="form-group">
                                    <h5>Slider Title <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="slider" type="text" name="title" value="{{$slider->title}}" class="form-control">
                                        @error('slider')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="description" id="textarea" class="form-control" required placeholder="Description">{{$slider->description}}</textarea>
                                        @error('description')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Slider Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="slider" type="file" name="slider_img" class="form-control"> 
                                        @error('slider')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>     
                       <div class="text-xs-right">
                           {{-- <button type="submit" class="btn btn-rounded btn-info">Save</button> --}}
                           <input type="submit" class="btn btn-rounded btn-info" value="Update">
                       </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
             <!-- /.box -->          
           </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
  </div>
@endsection