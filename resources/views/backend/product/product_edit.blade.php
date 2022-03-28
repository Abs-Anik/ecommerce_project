@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">

     <!-- Basic Forms -->
      <div class="box">
        <div class="box-header with-border">
          <h4 class="box-title">Edit Product</h4>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col">
                <form method="POST" action="{{route('product-update')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{$product->id}}" name="id">
                  <div class="row">
                    <div class="col-12">
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" required class="form-control" required="">
                                            <option value="" selected="" disabled="">Select Your Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{$brand->id}}" {{$brand->id == $product->brand_id ? 'selected' : ''}}>{{$brand->brand_name_en}}</option>
                                             @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Category Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" required class="form-control" required="">
                                            <option value="" selected="" disabled="">Select Your Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}" {{$category->id == $product->category_id ? 'selected' : ''}}>{{$category->category_name_en}}</option>
                                             @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subcategory_id" required class="form-control" required="">
                                            <option value="" selected="" disabled="">Select Your SubCategory</option>
                                            @foreach ($subcategories as $subcategory)
                                                <option value="{{$subcategory->id}}" {{$subcategory->id == $product->subcategory_id ? 'selected' : ''}}>{{$subcategory->subcategory_name_en}}</option>
                                             @endforeach
                                        </select>
                                        @error('subcategory_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Sub-SubCategory Select <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subsubcategory_id" required class="form-control" required="">
                                            <option value="" selected="" disabled="">Select Your Sub-SubCategory</option>
                                            @foreach ($subsubcategories as $subsubcategory)
                                                <option value="{{$subsubcategory->id}}" {{$subsubcategory->id == $product->subsubcategory_id ? 'selected' : ''}}>{{$subsubcategory->subsubcategory_name_en}}</option>
                                             @endforeach
                                        </select>
                                        @error('subsubcategory_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="form-group">
                                    <h5>Product Name En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_en" value="{{$product->product_name_en}}" class="form-control" required=""> 
                                        @error('product_name_en')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name Hin <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name_hin" value="{{$product->product_name_hin}}" class="form-control" required=""> 
                                        @error('product_name_hin')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Code <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_code" value="{{$product->product_code}}" class="form-control" required=""> 
                                        @error('product_code')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Quantity <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_qty" value="{{$product->product_qty}}" class="form-control" required=""> 
                                        @error('product_qty')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_tags_en" value="{{$product->product_tags_en}}" class="form-control" value="Lorem, Ipsum, Amet" data-role="tagsinput" required=""> 
                                        @error('product_tags_en')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags Hin <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_tags_hin" value="{{$product->product_tags_hin}}" class="form-control" value="Lorem, Ipsum, Amet" data-role="tagsinput" required=""> 
                                        @error('product_tags_hin')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Size En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_en" value="{{$product->product_size_en}}" class="form-control" value="Small, Large, Medium" data-role="tagsinput"> 
                                        @error('product_size_en')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Size Hin <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_size_hin" value="{{$product->product_size_hin}}" class="form-control" value="Small, Large, Medium" data-role="tagsinput"> 
                                        @error('product_size_hin')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Color En <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_color_en" value="{{$product->product_color_en}}" class="form-control" value="Red, Black, Green" data-role="tagsinput"> 
                                        @error('product_color_en')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Color Hin <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_color_hin" value="{{$product->product_color_hin}}" class="form-control" value="Red, Black, Green" data-role="tagsinput"> 
                                        @error('product_color_hin')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Selling Price <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="selling_price" value="{{$product->selling_price}}" class="form-control" required=""> 
                                        @error('selling_price')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Product Discount Price <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount_price" value="{{$product->discount_price}}" class="form-control"> 
                                        @error('discount_price')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Short Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_descp_en" id="textarea" class="form-control" required placeholder="Textarea text" required="">{!!$product->short_descp_en!!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Short Description Hindi <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="short_desp_hin" id="textarea" class="form-control" required placeholder="Textarea text" required="">{!!$product->short_desp_hin!!}</textarea>
                                        </div>
                                    </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>Long Description English <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="long_desp_en" id="editor1" class="form-control" rows="10" cols="80" required="">{!!$product->long_desp_en!!}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>Long Description Hindi <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="long_desp_hin" id="editor2" class="form-control" rows="10" cols="80" required="">{!!$product->long_desp_hin!!}</textarea>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_1" name="hot_deals" value="1" {{$product->hot_deals == '1' ? 'checked' : ''}}>
                                        <label for="checkbox_1">Hot Deals</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_2" name="featured" value="1" {{$product->featured == '1' ? 'checked' : ''}}>
                                        <label for="checkbox_2">Featured</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="controls">
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_3" name="special_offer" value="1" {{$product->special_offer == '1' ? 'checked' : ''}}>
                                        <label for="checkbox_3">Special Offer</label>
                                    </fieldset>
                                    <fieldset>
                                        <input type="checkbox" id="checkbox_4" name="special_deals" value="1" {{$product->special_deals == '1' ? 'checked' : ''}}>
                                        <label for="checkbox_4">Special Deals</label>
                                    </fieldset>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-xs-right">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
                    </div>
                </form>

            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->

    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box bt-3 border-info">
				  <div class="box-header">
					<h4 class="box-title">Product Multi Image <strong>Update</strong></h4>
				  </div>
                  <form action="{{route('product-update-image')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm p-3">
                        @foreach ($multiImages as $multiImage)
                            <div class="col-md-3">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{asset($multiImage->photo_name)}}" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                      <h5 class="card-title">
                                          <a href="{{route('product-multi-image', $multiImage->id)}}" class="btn btn-danger btn-sm" id="delete" title="Delete Data">
                                              <i class="fa fa-trash"></i>
                                          </a>
                                      </h5>
                                      <p class="card-text">
                                        <div class="form-group">
                                            <h5>Change Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="multi_img[{{$multiImage->id}}]" class="form-control">
                                            </div>
                                        </div>
                                      </p>
                                    </div>
                                  </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-xs-right p-3">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                    </div>
                    <br>
                    <br>
                  </form>
				</div>
			  </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
				<div class="box bt-3 border-info">
				  <div class="box-header">
					<h4 class="box-title">Product Thambnail Image <strong>Update</strong></h4>
				  </div>
                  <form action="{{route('product-update-thambnail-image')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="old_img" value="{{$product->product_thumbnail}}">
                    <div class="row row-sm p-3">
                            <div class="col-md-3">
                                <div class="card" style="width: 18rem;">
                                    <img class="card-img-top" src="{{asset($product->product_thumbnail)}}" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                      <p class="card-text">
                                        <div class="form-group">
                                            <h5>Change Image <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="product_thumbnail" class="form-control" onChange="mainThamUrl(this)" required="">
                                                <img src="" alt="" id="mainThmb" class="mt-2">
                                            </div>
                                        </div>
                                      </p>
                                    </div>
                                  </div>
                            </div>
                    </div>
                    <div class="text-xs-right p-3">
                        <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                    </div>
                    <br>
                    <br>
                  </form>
				</div>
			  </div>
        </div>
    </section>

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
            $('select[name="subsubcategory_id"]').html('');
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





      $('select[name="subcategory_id"]').on('change', function(){
        var subcategory_id = $(this).val();
        if(subcategory_id){
          $.ajax({
            url: "{{url('/category/sub-subcategory/ajax')}}/"+subcategory_id,
            type: "GET",
            dataType: "json",
            success:function(data){
              var d = $('select[name="subsubcategory_id"]').empty();
              $.each(data, function(key, value){
                $('select[name="subsubcategory_id"]').append(
                  '<option value="'+value.id+'">'+value.subsubcategory_name_en+'</option>'
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

<script type="text/javascript">
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src',e.target.result).width(80).height(80);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
 
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
     
</script>
  
@endsection