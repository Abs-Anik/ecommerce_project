@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        {{-- Add Brand --}}

        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Edit Sub-SubCategory</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="post" action="{{route('subsubcategory.update', $subsubcategory->id)}}">
                    @csrf   
                    <input type="hidden" name="id" value="{{$subsubcategory->id}}"> 
                                <div class="form-group">
                                  <h5>Category Select <span class="text-danger">*</span></h5>
                                  <div class="controls">
                                    <select name="category_id" id="select" class="form-control">
                                      <option value="" selected="" disabled="">Select Category</option>
                                      @foreach ($categories as $category)
                                      <option value="{{$category->id}}" {{$category->id == $subsubcategory->category_id ? 'selected' : ''}}>{{$category->category_name_en}}</option>
                                      @endforeach
                                    </select>
                                    @error('category_id')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group">
                                  <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                  <div class="controls">
                                    <select name="subcategory_id" id="select" class="form-control">
                                      <option value="" selected="" disabled="">Select SubCategory</option>
                                      @foreach ($subcategories as $subcat)
                                      <option value="{{$subcat->id}}" {{$subcat->id == $subsubcategory->subcategory_id ? 'selected' : ''}}>{{$subcat->subcategory_name_en}}</option>
                                      @endforeach
                                    </select>
                                    @error('subcategory_id')
                                      <span class="text-danger">{{$message}}</span>
                                    @enderror
                                  </div>
                                </div>
                                <div class="form-group">
                                  <h5>Sub-SubCategory Name EN <span class="text-danger">*</span></h5>
                                  <div class="controls">
                                      <input  id="subsubcategory_name_en" type="text" name="subsubcategory_name_en" value="{{$subsubcategory->subsubcategory_name_en}}" class="form-control">
                                      @error('subsubcategory_name_en')
                                        <span class="text-danger">{{$message}}</span>
                                      @enderror
                                  </div>
                              </div>
                                <div class="form-group">
                                    <h5>Sub-SubCategory Name HIN <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input  id="subsubcategory_name_hin" type="text" name="subsubcategory_name_hin" value="{{$subsubcategory->subsubcategory_name_hin}}" class="form-control"> 
                                        @error('subsubcategory_name_hin')
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

  <script type="text/javascript">
    $(document).ready(function(){
      $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id){
          $.ajax({
            url: "{{url('/category/subcategory/ajax')}}/"+category_id,
            type: "GET",
            dataType: "json",
            success:function(data){
              var d = $('select[name="subcategory_id"]').empty();
              $.each(data, function(key, value){
                $('select[name="subcategory_id"]').append(
                  '<option value="'+value.id+'">'+value.subcategory_name_en+'</option>'
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