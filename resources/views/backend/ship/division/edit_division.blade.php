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
                 <h3 class="box-title">Division Edit</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('division.update', $division->id)}}">
                    @csrf  
                    <div class="form-group">
                        <h5>Division Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input  id="division_name" type="text" name="division_name" value="{{$division->division_name}}" class="form-control">
                            @error('division_name')
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