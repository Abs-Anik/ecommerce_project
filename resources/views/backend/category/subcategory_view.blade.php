@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
          


        <div class="col-8">

         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">SubCategory List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>Category</th>
                            <th>Category En</th>
                            <th>Category Hin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $item)
                            <tr>
                              <td> {{ $item['category']['category_name_en'] }} </td>
                                <td>{{$item->subcategory_name_en}}</td>
                                <td>{{$item->subcategory_name_hin}}</td>
                                <td style="width: 30%;">
                                    <a href="{{route('subcategory.edit', $item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('subcategory.delete', $item->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          <!-- /.box -->          
        </div>
        <!-- /.col -->
        {{-- Add Brand --}}

        <div class="col-4">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add SubCategory</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('subcategory.store')}}">
                    @csrf   
                                <div class="form-group">
                                  <h5>Category Select <span class="text-danger">*</span></h5>
                                  <div class="controls">
                                    <select name="category_id" id="select" class="form-control">
                                      <option value="" selected="" disabled="">Select Category</option>
                                      @foreach ($categories as $category)
                                      <option value="{{$category->id}}">{{$category->category_name_en}}</option>
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
                                      <input  id="subcategory_name_en" type="text" name="subcategory_name_en" class="form-control">
                                      @error('subcategory_name_en')
                                        <span class="text-danger">{{$message}}</span>
                                      @enderror
                                  </div>
                              </div>
                                <div class="form-group">
                                    <h5>SubCategory Name HIN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="subcategory_name_hin" type="text" name="subcategory_name_hin" class="form-control"> 
                                        @error('subcategory_name_hin')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>   
                       <div class="text-xs-right">
                           {{-- <button type="submit" class="btn btn-rounded btn-info">Save</button> --}}
                           <input type="submit" class="btn btn-rounded btn-info" value="Save">
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