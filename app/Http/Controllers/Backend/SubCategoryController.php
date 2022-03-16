<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function SubCategoryView()
    {
        $subcategories = SubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.category.subcategory_view', compact('subcategories', 'categories'));
    }

    public function SubCategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_hin' => 'required',
        ],[
            'category_id.required' => 'Select Any Option',
            'subcategory_name_en.required' => 'Input SubCategory Name English',
            'subcategory_name_hin.required' => 'Input SubCategory Name Hindi',
        ]);

        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ','-',$request->subcategory_name_hin),
        ]);

        $notification = array(
            'Message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SubCategoryEdit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.category.subcategory_edit', compact('subcategory', 'categories'));
    }

    public function SubCategoryUpdate(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_name_en' => 'required',
            'subcategory_name_hin' => 'required',
        ],[
            'category_id.required' => 'Select Any Option',
            'subcategory_name_en.required' => 'Input SubCategory Name English',
            'subcategory_name_hin.required' => 'Input SubCategory Name Hindi',
        ]);
        $subcategory_id = $request->id;

        SubCategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name_en' => $request->subcategory_name_en,
            'subcategory_name_hin' => $request->subcategory_name_hin,
            'subcategory_slug_en' => strtolower(str_replace(' ','-',$request->subcategory_name_en)),
            'subcategory_slug_hin' => str_replace(' ','-',$request->subcategory_name_hin),
        ]);

        $notification = array(
            'Message' => 'SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.subcategory')->with($notification);

    }

    public function SubCategoryDelete($id)
    {
        SubCategory::findOrFail($id)->delete();

        $notification = array(
            'Message' => 'SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    //Sub Sub Category

    public function SubSubCategoryView()
    {
        $subsubcategories = SubSubCategory::latest()->get();
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        return view('backend.category.subsubcategory_view', compact('subsubcategories', 'categories'));
    }

    public function GetSubCategory($category_id)
    {
        $subcat = SubCategory::where('category_id', $category_id)->orderBy('subcategory_name_en', 'ASC')->get();
        return json_encode($subcat);
    }

    public function GetSubSubCategory($subcategory_id)
    {
        $subsubcat = SubSubCategory::where('subcategory_id', $subcategory_id)->orderBy('subsubcategory_name_en', 'ASC')->get();
        return json_encode($subsubcat);
    }

    public function SubSubCategoryStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_hin' => 'required',
        ],[
            'category_id.required' => 'Select Any Option',
            'subcategory_id.required' => 'Select Any Category',
            'subsubcategory_name_en.required' => 'Input Sub-SubCategory Name English',
            'subsubcategory_name_hin.required' => 'Input Sub-SubCategory Name Hindi',
        ]);

        SubSubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ','-',$request->subsubcategory_name_hin),
        ]);

        $notification = array(
            'Message' => 'Sub-SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function SubSubCategoryEdit($id)
    {
        $subsubcategory = SubSubCategory::findOrFail($id);
        $category_id = $subsubcategory->category_id;
        $categories = Category::orderBy('category_name_en', 'ASC')->get();
        $subcategories = SubCategory::where('sub_categories.category_id', $category_id)
        ->orderBy('subcategory_name_en', 'ASC')->get();
        return view('backend.category.subsubcategory_edit', compact('subsubcategory', 'categories', 'subcategories'));
    }

    public function SubSubCategoryUpdate(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'subsubcategory_name_en' => 'required',
            'subsubcategory_name_hin' => 'required',
        ],[
            'category_id.required' => 'Select Any Option',
            'subcategory_id.required' => 'Select Any Category',
            'subsubcategory_name_en.required' => 'Input Sub-SubCategory Name English',
            'subsubcategory_name_hin.required' => 'Input Sub-SubCategory Name Hindi',
        ]);
        $subsubcategory_id = $request->id;

        // return $subsubcategory_id;

        SubSubCategory::findOrFail($subsubcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_name_en' => $request->subsubcategory_name_en,
            'subsubcategory_name_hin' => $request->subsubcategory_name_hin,
            'subsubcategory_slug_en' => strtolower(str_replace(' ','-',$request->subsubcategory_name_en)),
            'subsubcategory_slug_hin' => str_replace(' ','-',$request->subsubcategory_name_hin),
        ]);

        $notification = array(
            'Message' => 'Sub-SubCategory Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('all.subsubcategory')->with($notification);

    }

    public function SubSubCategoryDelete($id)
    {
        SubSubCategory::findOrFail($id)->delete();

        $notification = array(
            'Message' => 'Sub-SubCategory Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

}
