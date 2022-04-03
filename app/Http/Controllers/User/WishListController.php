<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    public function ViewWishList()
    {
        return view('frontend.wishlist.view_wishlist');
    }

    public function GetWishListProduct()
    {
        $wishList = WishList::with('product')->where('user_id', Auth::id())->latest()->get();

        return response()->json($wishList);
    }

    public function RemoveWishListProduct($rowId)
    {
        WishList::where('user_id', Auth::id())->where('id', $rowId)->delete();
        return response()->json(['success' => 'Successfully Product Remove']);
    }
}
