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
                 <h3 class="box-title">Coupon Edit</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('coupon.update', $coupon->id)}}">
                    @csrf  
                    <div class="form-group">
                        <h5>Coupon Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input  id="coupon_name" type="text" name="coupon_name" value="{{$coupon->coupon_name}}" class="form-control">
                            @error('coupon_name')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Coupon Discount(%) <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input  id="coupon_discount" type="text" name="coupon_discount" value="{{$coupon->coupon_discount}}" class="form-control"> 
                            @error('coupon_discount')
                              <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>Coupon Validity <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input  id="coupon_validity" type="date" name="coupon_validity" value="{{$coupon->coupon_validity}}" class="form-control" min="{{Carbon\Carbon::now()->format('Y-m-d')}}"> 
                            @error('coupon_validity')
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