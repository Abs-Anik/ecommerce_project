<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Product;
use App\Models\MultiImg;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\Process\Process;

class ProductController extends Controller
{
    public function AddProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();

        return view('backend.product.product_add', compact('categories', 'brands'));
    }

    public function StoreProduct(Request $request)
    {
        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

        $product_id = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_hin' => $request->product_name_hin,
            'product_slug_en' => strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_hin' => str_replace(' ','-',$request->product_name_hin),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_hin' => $request->product_tags_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_desp_hin' => $request->short_desp_hin,
            'long_desp_en' => $request->long_desp_en,
            'long_desp_hin' => $request->long_desp_hin,
            'product_thumbnail' => $save_url,
            'hot_deals'=> $request->hot_deals,
            'featured'=> $request->featured,
            'special_offer'=> $request->special_offer,
            'special_deals'=> $request->special_deals,
            'status'=> 1,
            'created_at' => Carbon::now(),
        ]);

        $images = $request->file('multi_img');

        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::insert([
                'product_id' => $product_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'Message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function ManageProduct()
    {
        $products = Product::latest()->get();
        return view('backend.product.product_view', compact('products'));
    }

    public function EditProduct($id)
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $brands= Brand::latest()->get();
        $product= Product::findOrFail($id);
        $multiImages = MultiImg::where('product_id', $id)->get();
        return view('backend.product.product_edit', compact('categories', 'subcategories', 'subsubcategories', 'brands', 'product', 'multiImages'));
    }

    public function UpdateProduct(Request $request)
    {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'product_name_en' => $request->product_name_en,
            'product_name_hin' => $request->product_name_hin,
            'product_slug_en' => strtolower(str_replace(' ','-',$request->product_name_en)),
            'product_slug_hin' => str_replace(' ','-',$request->product_name_hin),
            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags_en' => $request->product_tags_en,
            'product_tags_hin' => $request->product_tags_hin,
            'product_size_en' => $request->product_size_en,
            'product_size_hin' => $request->product_size_hin,
            'product_color_en' => $request->product_color_en,
            'product_color_hin' => $request->product_color_hin,
            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp_en' => $request->short_descp_en,
            'short_desp_hin' => $request->short_desp_hin,
            'long_desp_en' => $request->long_desp_en,
            'long_desp_hin' => $request->long_desp_hin,
            'hot_deals'=> $request->hot_deals,
            'featured'=> $request->featured,
            'special_offer'=> $request->special_offer,
            'special_deals'=> $request->special_deals,
            'status'=> 1,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'Message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage-product')->with($notification);
    }

    public function UpdateProductImage(Request $request)
    {
        $imges = $request->multi_img;
        foreach($imges as $id => $img){
            $imgDel = MultiImg::findOrFail($id);
            unlink($imgDel->photo_name);
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(917, 1000)->save('upload/products/multi-image/'.$make_name);
            $uploadPath = 'upload/products/multi-image/'.$make_name;

            MultiImg::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'Message' => 'Product Image Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function UpdateProductThambnailImage(Request $request)
    {
        $product_id = $request->id;
        $oldImage = $request->old_img;
        unlink($oldImage);

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(917, 1000)->save('upload/products/thambnail/'.$name_gen);
        $save_url = 'upload/products/thambnail/'.$name_gen;

        Product::findOrFail($product_id)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'Message' => 'Product Thambnail Image Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }

    public function DeleteProductMultiImage($id)
    {
        $oldImg = MultiImg::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImg::findOrFail($id)->delete();

        $notification = array(
            'Message' => 'Product Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductInactive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 0,
        ]);

        $notification = array(
            'Message' => 'Product Inactive Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function ProductActive($id)
    {
        Product::findOrFail($id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'Message' => 'Product Active Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ProductDelete($id)
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImg::where('product_id', $id)->get();

        foreach($images as $img)
        {
            unlink($img->photo_name);
            MultiImg::where('product_id', $id)->delete();
        }

        
        $notification = array(
            'Message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function ViewProduct($id)
    {
        $categories = Category::latest()->get();
        $subcategories = SubCategory::latest()->get();
        $subsubcategories = SubSubCategory::latest()->get();
        $brands= Brand::latest()->get();
        $product= Product::findOrFail($id);
        $multiImages = MultiImg::where('product_id', $id)->get();
        return view('backend.product.product_show', compact('categories', 'subcategories', 'subsubcategories', 'brands', 'product', 'multiImages'));
    }
}
