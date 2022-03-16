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
                 <h3 class="box-title">Category Edit</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('category.update', $category->id)}}">
                    @csrf  
                    <input type="hidden" name="id" value="{{$category->id}}"> 
                                <div class="form-group">
                                    <h5>Category Name EN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="category_name_en" type="text" name="category_name_en" value="{{$category->category_name_en}}" class="form-control">
                                        @error('category_name_en')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Category Name HIN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="category_name_hin" type="text" name="category_name_hin" value="{{$category->category_name_hin}}" class="form-control"> 
                                        @error('category_name_hin')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Category Icon <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="category_icon" type="text" name="category_icon" value="{{$category->category_icon}}" class="form-control"> 
                                        @error('category_icon')
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