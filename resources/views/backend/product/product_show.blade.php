@extends('admin.admin_master')
@section('admin')
<div class="container-full">
    <!-- Main content -->
    <section class="content">
      <div class="row">
          


        <div class="col-md-12">
					          
           <div class="box">
                <div class="box-header">
                    <h6 class="box-title"><a href="{{route('manage-product')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i></a> Product Detail</h6>
                    <div class="box-controls pull-right">
                            <a href="#" class="animation" data-animation="tada"><i class="fa fa-play"></i></a>
                    </div>
                </div>

                <div class="box-body">
                    <div class="card mb-3">
                        <div class="container-fliud">
                            <div class="wrapper row">
                                <div class="preview col-md-6 mb-2">
                                    
                                    <div class="preview-pic tab-content p-4">
                                      <div class="tab-pane active" id="pic-1"><img src="{{asset($product->product_thumbnail)}}" style="width: 400px; height: 400px;"/></div>
                                    </div>
                                    <ul class="preview-thumbnail nav nav-tabs p-4">
                                        @foreach ($multiImages as $multiImage)
                                            <li class="mr-1"><a data-target="#pic-1" data-toggle="tab"><img src="{{asset($multiImage->photo_name)}}" width="100px" height="100px"/></a></li>
                                        @endforeach
                                    </ul>
                                    
                                </div>
                                <div class="details col-md-6">
                                    <h3 class="product-title">{{$product->product_name_en}} ({{$product->product_name_hin}})</h3>
                                    <p>

                                    <span class="badge badge-success mt-2">
                                     Brand:
                                        @foreach ($brands as $brand)
    
                                        @if ($brand->id == $product->brand_id)
                                            {{$brand->brand_name_en}} ({{$brand->brand_name_hin}})
                                        @endif
                                             
                                            @endforeach
                                    </span>
                                    <span class="badge badge-success mt-2">
                                        Category:
                                        @foreach ($categories as $category)

                                        @if ($category->id == $product->category_id)
                                            {{$category->category_name_en}} ({{$category->category_name_hin}})
                                        @endif
                                         
                                        @endforeach
                                    </span>
                                     <span class="badge badge-primary mt-2"> 
                                         
                                        SubCategory: 
                                        @foreach ($subcategories as $subcategory)

                                        @if ($subcategory->id == $product->subcategory_id)
                                            {{$subcategory->subcategory_name_en}} ({{$subcategory->subcategory_name_hin}})
                                        @endif
                                         
                                        @endforeach
                                    </span>
                                    <span class="badge badge-info mt-2"> 
                                        SubSubCategory: 

                                        @foreach ($subsubcategories as $subsubcategory)

                                        @if ($subsubcategory->id == $product->subsubcategory_id)
                                            {{$subsubcategory->subsubcategory_name_en}} ({{$subsubcategory->subsubcategory_name_hin}})
                                        @endif
                                         
                                        @endforeach
                                    </span>
                                    </p>
                                    <p class="product-description">{{$product->short_descp_en}} ({{$product->short_desp_hin}})</p>
                                    <h5>Seeling Price: <span>{{$product->selling_price}}</span></h5>
                                    <h5>Discount Price: <span>{{$product->discount_price}}</span></h5>
                                    <h5>Product Quantity: <span>{{$product->product_qty}}</span></h5>
                                    <h5>Product Code: <span>{{$product->product_code}}</span></h5>
                                    <h5>Tags : <span>{{$product->product_tags_en}} ({{$product->product_tags_hin}})</span></h5>
                                    <h5 class="sizes">sizes:
                                        <span class="size">{{$product->product_size_en}} ({{$product->product_size_hin}})</span>
                                    </h5>
                                    <h5 class="colors">colors:
                                        <span class="size">{{$product->product_color_en}} ({{$product->product_color_hin}})</span>
                                    </h5>
                                    <p>
                                        {!! $product->long_desp_en !!}
                                    </p>
                                    {{-- <p>
                                        {!! $product->long_desp_hin !!}
                                    </p> --}}

                                    @if ($product->hot_deals == '1')
                                        <p><span class="badge badge-warning">Hot Deals</span></p>
                                    @endif
                                    @if ($product->featured == '1')
                                        <p><span class="badge badge-info">Featured</span></p>
                                    @endif
                                    @if ($product->special_offer == '1')
                                        <p><span  class="badge badge-danger">Special Offer</span></p>
                                    @endif
                                    @if ($product->special_deals == '1')
                                        <p><span class="badge badge-info">Special Deals</span></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <!-- /.col -->
        {{-- Add Brand --}}
      <!-- /.row -->
    </section>
    <!-- /.content -->
  
</div>
@endsection