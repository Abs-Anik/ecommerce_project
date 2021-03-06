<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i> Categories</div>
    <nav class="yamm megamenu-horizontal">
      <ul class="nav">
      @foreach ($categories as $category)
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon {{$category->category_icon}}" aria-hidden="true"></i>
          @if (session()->get('language') == 'hindi')
            {{$category->category_name_hin}}
          @else
            {{$category->category_name_en}}
          @endif
          </a>
            <ul class="dropdown-menu mega-menu">
              <li class="yamm-content">
                <div class="row">
                  @php
                    $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name_en', 'ASC')->get();
                  @endphp
                  @foreach ($subcategories as $subcategory)
                  <div class="col-sm-12 col-md-3">
                    <a href="{{route('subcategory.product', ['id'=>$subcategory->id,'slug'=>$subcategory->subcategory_slug_en])}}">
                      @if (session()->get('language') == 'hindi')
                        <h2 class="title">{{$subcategory->subcategory_name_hin}}</h2>
                      @else
                        <h2 class="title">{{$subcategory->subcategory_name_en}}</h2>
                      @endif
                    </a>
                    @php
                      $subsubcategories = App\Models\SubSubCategory::where('subcategory_id', $subcategory->id)->orderBy('subsubcategory_name_en', 'ASC')->get();
                    @endphp

                    @foreach ($subsubcategories as $subsubcategory)
                    <ul class="links list-unstyled">
                      <li><a href="{{route('subsubcategory.product', ['id'=>$subsubcategory->id,'slug'=>$subsubcategory->subsubcategory_slug_en])}}">
                        @if (session()->get('language') == 'hindi')
                        {{$subsubcategory->subsubcategory_name_hin}}
                        @else
                        {{$subsubcategory->subsubcategory_name_en}}
                        @endif
                      </a></li>
                    </ul>
                    @endforeach
                  </div>
                  @endforeach
                  <!-- /.col -->
                  <!-- /.col --> 
                </div>
                <!-- /.row --> 
              </li>
              <!-- /.yamm-content -->
            </ul>
            <!-- /.dropdown-menu --> 
        </li>
        <!-- /.menu-item -->
      @endforeach
        
        <!-- /.menu-item -->
        
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-paper-plane"></i>Kids and Babies</a> 
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->
        
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-futbol-o"></i>Sports</a> 
          <!-- ================================== MEGAMENU VERTICAL ================================== --> 
          <!-- /.dropdown-menu --> 
          <!-- ================================== MEGAMENU VERTICAL ================================== --> </li>
        <!-- /.menu-item -->
        
        <li class="dropdown menu-item"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon fa fa-envira"></i>Home and Garden</a> 
          <!-- /.dropdown-menu --> </li>
        <!-- /.menu-item -->
        
      </ul>
      <!-- /.nav --> 
    </nav>
    <!-- /.megamenu-horizontal --> 
  </div>