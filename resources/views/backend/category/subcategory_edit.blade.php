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
                 <h3 class="box-title">SubCategory Edit</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('subcategory.update', $subcategory->id)}}">
                    @csrf  
                    <input type="hidden" name="id" value="{{$subcategory->id}}"> 
                    <div class="form-group">
                      <h5>Category Select <span class="text-danger">*</span></h5>
                      <div class="controls">
                        <select name="category_id" id="select" class="form-control">
                          <option value="" selected="" disabled="">Select Category</option>
                          @foreach ($categories as $category)
                          <option value="{{$category->id}}" {{$category->id == $subcategory->category_id ? 'selected' : ''}}>{{$category->category_name_en}}</option>
                          @endforeach
                        </select>
                        @error('category_id')
                          <span class="text-danger">{{$message}}</span>
                        @enderror
                      </div>
                    </div>
                                <div class="form-group">
                                    <h5>SubCategory Name EN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="subcategory_name_en" type="text" name="subcategory_name_en" value="{{$subcategory->subcategory_name_en}}" class="form-control">
                                        @error('subcategory_name_en')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>SubCategory Name HIN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="subcategory_name_hin" type="text" name="subcategory_name_hin" value="{{$subcategory->subcategory_name_hin}}" class="form-control"> 
                                        @error('subcategory_name_hin')
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