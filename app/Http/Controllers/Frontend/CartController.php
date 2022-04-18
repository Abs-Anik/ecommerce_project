<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShipDivision;
use App\Models\WishList;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id)
    {
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        
        $product = Product::findOrFail($id);

        if($product->discount_price == NULL){

            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
                ]);

                return response()->json(['success' => 'Successfully Added on Your Cart']);

        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'options' => [
                    'image' => $product->product_thumbnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
                ]);

                return response()->json(['success' => 'Successfully Added on Your Cart']);
        }
        
    }

    public function AddMiniCart()
    {
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => round($cartTotal),
        ));
    }

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product Remove From Cart']);
    }

    public function AddToWishList(Request $request, $productId)
    {
        if(Auth::check()){
            $exists = WishList::where('user_id', Auth::id())->where('product_id', $productId)->first();
            if(!$exists){
                WishList::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'created_at' => Carbon::now()
                ]);
    
                return response()->json(['success' => 'Successfully Added on Your Wish List']);
            }else{
                return response()->json(['error' => 'This Product Already Has on Your Wish List']);
            }

        }else{
            return response()->json(['error' => 'At First Login Your Account']);
        }
    }

    public function CuoponApply(Request $request)
    {
        $coupon = Coupon::where('coupon_name', $request->coupon_name)
        ->where('coupon_validity', '>=', Carbon::now()->format('Y-m-d'))
        ->first();

        if($coupon)
        {
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount / 100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount / 100),
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));
            
        }else{
            return response()->json(['error' => 'Invalid Coupon']);
        }
    }

    public function CuoponCalculation()
    {
        if(Session::has('coupon')){
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],
                'coupon_discount' => session()->get('coupon')['coupon_discount'],
                'discount_amount' => session()->get('coupon')['discount_amount'],
                'total_amount' => session()->get('coupon')['total_amount'],
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    }

    public function CuoponRemove()
    {
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Removed Successfully']);
    }

    public function CheckOut()
    {
        if(Auth::check()){

            if(Cart::total() > 0){

                $carts = Cart::content();
                $cartQty = Cart::count();
                $cartTotal = Cart::total();
                $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
                return view('frontend.checkout.checkout_view', compact('carts', 'cartQty', 'cartTotal', 'divisions'));

            }else{
                $notification = array(
                    'Message' => 'Shopping At Least One Product',
                    'alert-type' => 'error'
                );
        
                return redirect()->to('/')->with($notification);
            }

        }else{
        $notification = array(
            'Message' => 'You Need To Login First',
            'alert-type' => 'error'
        );

        return redirect()->route('login')->with($notification);
        }
    }

    public function CheckOutStore(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['post_code'] = $request->post_code;
        $data['division_id'] = $request->division_id;
        $data['district_id'] = $request->district_id;
        $data['state_id'] = $request->state_id;
        $data['notes'] = $request->notes;
        $cartTotal = Cart::total();
        if($request->payment_method == 'stripe')
        {
            return view('frontend.payment.stripe', compact('data', 'cartTotal'));
        }elseif($request->payment_method == 'card')
        {
            return 'card';
        }else{
            return 'cash';
        }
    }
}
