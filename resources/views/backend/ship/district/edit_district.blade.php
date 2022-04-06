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
                 <h3 class="box-title">District Edit</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('district.update', $district->id)}}">
                    @csrf
                    
                    <div class="form-group">
                        <h5>Division Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                          <select name="division_id" id="select" class="form-control">
                            <option value="" selected="" disabled="">Select Division</option>
                            @foreach ($divisions as $division)
                            <option value="{{$division->id}}" {{$division->id == $district->division_id ? "selected" : ""}}>{{$division->division_name}}</option>
                            @endforeach
                          </select>
                          @error('division_id')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>District Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input  id="district_name" type="text" name="district_name" value="{{$district->district_name}}" class="form-control">
                            @error('district_name')
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