@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
          


        <div class="col-8">

         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Brand List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Brand En</th>
                            <th>Brand Hin</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $item)
                            <tr>
                                <td>{{$item->brand_name_en}}</td>
                                <td>{{$item->brand_name_hin}}</td>
                                <td>
                                    <img src="{{asset($item->brand_image)}}" alt="brand image" style="width:70px; height:50px">
                                </td>
                                <td>
                                    <a href="{{route('brand.edit', $item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('brand.delete', $item->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
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
                 <h3 class="box-title">Add Brand</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('brand.store')}}" enctype="multipart/form-data">
                    @csrf   
                                <div class="form-group">
                                    <h5>Brand Name EN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="brand_name_en" type="text" name="brand_name_en" class="form-control">
                                        @error('brand_name_en')
                                          <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h5>Brand Name HIN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="brand_name_hin" type="text" name="brand_name_hin" class="form-control"> 
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