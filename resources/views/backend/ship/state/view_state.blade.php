@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
          
        <div class="col-8">

         <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">State List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                          <th>Division Name</th>
                          <th>District Name</th>
                          <th>State Name</th>
                          <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($states as $item)
                            <tr>
                              <td>{{ $item->shipdivision->division_name}}</td>
                              <td>{{ $item->shipdistrict->district_name}}</td>
                              <td>{{$item->state_name}}</td>
                                <td>
                                    <a href="{{route('state.edit', $item->id)}}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                    <a href="{{route('state.delete', $item->id)}}" class="btn btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i></a>
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
                 <h3 class="box-title">Add State</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="POST" action="{{route('state.store')}}">
                    @csrf   
                    <div class="form-group">
                        <h5>Division Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                          <select name="division_id" id="division_id" class="form-control">
                            <option value="" selected="" disabled="">Select Division</option>
                            @foreach ($divisions as $division)
                            <option value="{{$division->id}}">{{$division->division_name}}</option>
                            @endforeach
                          </select>
                          @error('division_id')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <h5>District Select <span class="text-danger">*</span></h5>
                        <div class="controls">
                          <select name="district_id" id="district_id" class="form-control">
                            <option value="" selected="" disabled="">Select District</option>
                          </select>
                          @error('district_id')
                            <span class="text-danger">{{$message}}</span>
                          @enderror
                        </div>
                    </div>
                                <div class="form-group">
                                    <h5>State Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="state_name" type="text" name="state_name" class="form-control">
                                        @error('state_name')
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

<script type="text/javascript">
    $(document).ready(function(){
      $('select[name="division_id"]').on('change', function(){
        var division_id = $(this).val();
        console.log('division_id:', division_id)
        if(division_id){
          $.ajax({
            url: "{{url('/shipping/division/district/ajax')}}/"+division_id,
            type: "GET",
            dataType: "json",
            success:function(data){
              var d = $('select[name="district_id"]').empty();
              $.each(data, function(key, value){
                $('select[name="district_id"]').append(
                  '<option value="'+value.id+'">'+value.district_name+'</option>'
                );
              });
            },
          });
        }else{
          alert('Data Not Found');
        }
      });
    });
</script>
@endsection