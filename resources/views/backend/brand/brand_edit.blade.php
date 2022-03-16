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
                 <h3 class="box-title">Edit Brand</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('brand.update', $brand->id)}}" enctype="multipart/form-data">
                    @csrf  
                    <input type="hidden" name="id" value="{{$brand->id}}"> 
                    <input type="hidden" name="old_image" value="{{$brand->brand_image}}"> 
                                <div class="form-group">
                                    <h5>Brand Name EN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="brand_name_en" type="text" name="brand_name_en" value="{{$brand->brand_name_en}}" class="form-control">
                                        @error('brand_name_en')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Brand Name HIN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="brand_name_hin" type="text" name="brand_name_hin" value="{{$brand->brand_name_hin}}" class="form-control"> 
                                        @error('brand_name_hin')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Brand Image <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="brand_image" type="file" name="brand_image" class="form-control"> 
                                        @error('brand_image')
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