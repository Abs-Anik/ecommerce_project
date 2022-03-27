<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImg;
use App\Models\Slider;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index()
    {
        $sliders = Slider::where('status', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $featureds = Product::where('status', 1)->where('featured', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $hot_deals = Product::where('status', 1)->where('hot_deals', 1)->where('discount_price', '!=', NULL)->orderBy('id', 'DESC')->limit(3)->get();
        $special_offers = Product::where('status', 1)->where('special_offer', 1)->orderBy('id', 'DESC')->limit(6)->get();
        $special_deals = Product::where('status', 1)->where('special_deals', 1)->orderBy('id', 'DESC')->limit(3)->get();
        $skip_category_0 = Category::skip(0)->first();
        $skip_product_0 = Product::where('status', 1)->where('category_id', $skip_category_0->id)->orderBy('id', 'DESC')->get();
        $skip_category_1 = Category::skip(1)->first();
        $skip_product_1 = Product::where('status', 1)->where('category_id', $skip_category_1->id)->orderBy('id', 'DESC')->get();
        $skip_brand_1 = Brand::skip(1)->first();
        $skip_brand_product_1 = Product::where('status', 1)->where('brand_id', $skip_brand_1->id)->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('frontend.index', compact('categories', 'sliders', 'products', 'featureds', 'hot_deals', 'special_offers', 'special_deals', 'skip_category_0', 'skip_product_0', 'skip_category_1', 'skip_product_1', 'skip_brand_1', 'skip_brand_product_1'));
    }

    public function userLogout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile', compact('user'));
    }

    public function userProfileStore(Request $request)
    {
        $data = User::find(Auth::user()->id);

        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        if($request->file('profile_photo_path')){
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $file = $request->file('profile_photo_path');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data->profile_photo_path = $filename;
        }
        $data->save();

        $notification = array(
            'Message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('dashboard')->with($notification);
    }

    public function userPasswordChange()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.change_password', compact('user'));
    }

    public function userPasswordStore(Request $request)
    {
        $validateData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword))
        {
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }
        else{
            return redirect()->back();
        }
    }

    public function ProductDetails($id, $slug)
    {
        $product = Product::findOrFail($id);

        $size_en = $product->product_size_en;
        $product_size_en = explode(',',$size_en);
        $size_hin = $product->product_size_hin;
        $product_size_hin = explode(',',$size_hin);

        $color_en = $product->product_color_en;
        $product_color_en = explode(',',$color_en);
        $color_hin = $product->product_color_hin;
        $product_color_hin = explode(',',$color_hin);

        $cat_id = $product->category_id;
        $relatedProducts = Product::where('status',1)->where('category_id',$cat_id)->where('id', '!=', $id)->orderBy('id','DESC')->get();
        $multiImg = MultiImg::where('product_id', $id)->get();
        return view('frontend.product.product_details', compact('product', 'multiImg', 'product_size_hin', 'product_color_hin', 'product_size_en', 'product_color_en', 'relatedProducts'));
    }

    public function TagWiseProduct($tag)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('status',1)->where('product_tags_en',$tag)->orWhere('product_tags_hin',$tag)->orderBy('id','DESC')->paginate(3);
        return view('frontend.tag.tags_view', compact('products', 'categories'));
    }

    public function SubcategoryWiseProduct($id, $slug)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('status',1)->where('subcategory_id',$id)->orderBy('id','DESC')->paginate(3);
        return view('frontend.product.subcategory_view', compact('products', 'categories'));
    }

    public function SubSubcategoryWiseProduct($id, $slug)
    {
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $products = Product::where('status',1)->where('subsubcategory_id',$id)->orderBy('id','DESC')->paginate(3);
        return view('frontend.product.subsubcategory_view', compact('products', 'categories'));
    }

    //Product View With Ajax

    public function ProductViewAjax($id)
    {
        $product = Product::with('category', 'brand')->findOrFail($id);

        $size = $product->product_size_en;
        $product_size = explode(',',$size);

        $color = $product->product_color_en;
        $product_color = explode(',',$color);

        return response()->json(array('product' => $product, 'color' => $product_color, 'size' => $product_size));
    }
}
