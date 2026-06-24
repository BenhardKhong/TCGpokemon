<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderCard;
use App\Models\User;
use App\Models\UserCard;
use App\Models\UserLocation;

class CartController extends Controller
{
    // =========================
    // CART PAGE
    // =========================

    public function index()
    {
        // LOGIN

        if(!session()->has('user_id'))
        {
            return redirect('/login');
        }

        // CARTS

        $carts = Cart::with([
            'product'
        ])
        ->where(
            'user_id',
            session('user_id')
        )
        ->get();

        // LOCATIONS

        $locations =
        UserLocation::where(
            'user_id',
            session('user_id')
        )->get();

        // USER CARDS

        $cards = UserCard::with([
            'pokemonCard'
        ])
        ->where(
            'user_id',
            session('user_id')
        )->get();

        return view(
            'cart',
            compact(
                'carts',
                'locations',
                'cards'
            )
        );
    }

    // =========================
    // ADD TO CART
    // =========================

    public function add($id)
    {
        // LOGIN

        if(!session()->has('user_id'))
        {
            return redirect('/login');
        }

        // PRODUCT

        $product =
        Product::find($id);

        // CHECK EXIST

        $cart = Cart::where(
            'user_id',
            session('user_id')
        )
        ->where(
            'product_id',
            $id
        )
        ->first();

        // EXIST

        if($cart)
        {
            // STOCK LIMIT

            if(
                $cart->quantity + 1
                > $product->stock
            )
            {
                return back()->with(
                    'error',
                    'Stock tidak cukup'
                );
            }

            $cart->quantity += 1;

            $cart->save();
        }

        // NEW

        else
        {
            Cart::create([

                'user_id' =>
                session('user_id'),

                'product_id' =>
                $id,

                'quantity' =>
                1

            ]);
        }

        return back()->with(
            'success',
            'Product ditambahkan ke cart'
        );
    }

    // =========================
    // CHECKOUT
    // =========================

    public function checkout(Request $request){

        // =========================
        // VALIDATION
        // =========================

        if(!$request->selected_cart)
        {
            return back()->with(
                'error',
                'Pilih product terlebih dahulu'
            );
        }

        // LOGIN

        if(!session()->has('user_id'))
        {
            return redirect('/login');
        }

        // USER

        $user = User::find(
            session('user_id')
        );

        // CARTS

        $carts = Cart::with([
            'product'
        ])
        ->whereIn(
            'id',
            $request->selected_cart
        )
        ->get();

        // TOTAL

        $total = 0;

        foreach($carts as $cart)
        {
            $total +=
            $cart->product->price
            * $cart->quantity;
        }

        // WALLET CHECK

        if($user->wallet < $total)
        {
            return back()->with(
                'error',
                'Saldo tidak cukup'
            );
        }

        // LOCATION VALIDATION
        if(!$request->location_id ||
           !UserLocation::where('id', $request->location_id)
                ->where('user_id', $user->id)
                ->exists()
        )
        {
            return back()->with(
                'error',
                'Pilih lokasi pengiriman yang valid terlebih dahulu'
            );
        }

        // CREATE ORDER

        $order = Order::create([

            'user_id' =>
            $user->id,

            'location_id' =>
            $request->location_id,

            'total_price' =>
            $total,

            'status' =>
            'paid'

        ]);

        // ITEMS

        foreach($carts as $cart)
        {
            OrderItem::create([

                'order_id' =>
                $order->id,

                'product_id' =>
                $cart->product_id,

                'quantity' =>
                $cart->quantity,

                'price' =>
                $cart->product->price

            ]);

            // REDUCE STOCK

            $product =
            Product::find(
                $cart->product_id
            );

            $product->stock -=
            $cart->quantity;

            $product->save();
        }

        // ATTACHED CARDS

        if($request->cards)
        {
            foreach(
                $request->cards
                as $cardId
            )
            {
                OrderCard::create([

                    'order_id' =>
                    $order->id,

                    'user_card_id' =>
                    $cardId

                ]);

                // REMOVE CARD

                UserCard::find($cardId)
                ?->delete();
            }
        }

        // REDUCE WALLET

        $user->wallet -= $total;

        $user->save();

        // CLEAR CART

        Cart::where(
            'user_id',
            $user->id
        )->delete();

        return redirect('/cart')
        ->with(
            'success',
            'Checkout berhasil'
        );
    }
    // =========================
    // BUY NOW PAGE
    // =========================

    public function buyNow($id)
    {
        // LOGIN

        if(!session()->has('user_id'))
        {
            return redirect('/login');
        }

        // PRODUCT

        $product = Product::find($id);

        // LOCATIONS

        $locations =
        UserLocation::where(
            'user_id',
            session('user_id')
        )->get();

        // USER CARDS

        $cards = UserCard::with([
            'pokemonCard'
        ])
        ->where(
            'user_id',
            session('user_id')
        )
        ->get();

        return view(
            'buy-now',
            compact(
                'product',
                'locations',
                'cards'
            )
        );
    }

    // =========================
    // BUY NOW CHECKOUT
    // =========================

    public function buyNowCheckout(Request $request,$id){
        // LOGIN

        if(!session()->has('user_id'))
        {
            return redirect('/login');
        }

        // USER

        $user = User::find(
            session('user_id')
        );

        // PRODUCT

        $product = Product::find($id);

        // STOCK

        if($product->stock < 1)
        {
            return back()->with(
                'error',
                'Stock habis'
            );
        }

        // WALLET

        if($user->wallet < $product->price)
        {
            return back()->with(
                'error',
                'Saldo tidak cukup'
            );
        }

        // ORDER

        $order = Order::create([

            'user_id' =>
            $user->id,

            'location_id' =>
            $request->location_id,

            'total_price' =>
            $product->price,

            'status' =>
            'paid'

        ]);

        // ITEM

        OrderItem::create([

            'order_id' =>
            $order->id,

            'product_id' =>
            $product->id,

            'quantity' =>
            1,

            'price' =>
            $product->price

        ]);

        // REDUCE STOCK

        $product->stock -= 1;

        $product->save();

        // ATTACH CARD

        if($request->cards)
        {
            foreach(
                $request->cards
                as $cardId
            )
            {
                OrderCard::create([

                    'order_id' =>
                    $order->id,

                    'user_card_id' =>
                    $cardId

                ]);

                // REMOVE CARD

                UserCard::find($cardId)
                ?->delete();
            }
        }

        // REDUCE WALLET

        $user->wallet -=
        $product->price;

        $user->save();

        return redirect('/marketplace')
        ->with(
            'success',
            'Pembelian berhasil'
        );

        
    }

    // =========================
    // INCREASE
    // =========================

    public function increase($id)
    {
        $cart = Cart::find($id);

        // PRODUCT

        $product = Product::find(
            $cart->product_id
        );

        // STOCK LIMIT

        if(
            $cart->quantity + 1
            > $product->stock
        )
        {
            return back()->with(
                'error',
                'Stock tidak cukup'
            );
        }

        $cart->quantity += 1;

        $cart->save();

        return back();
    }

    // =========================
    // DECREASE
    // =========================

    public function decrease($id)
    {
        $cart = Cart::find($id);

        // MIN LIMIT

        if($cart->quantity <= 1)
        {
            $cart->delete();

            return back();
        }

        $cart->quantity -= 1;

        $cart->save();

        return back();
    }


    // =========================
    // DELETE CART
    // =========================

    public function delete($id)
    {
        Cart::find($id)?->delete();

        return back()->with(
            'success',
            'Product dihapus dari cart'
        );
    }
    // =========================
    // ORDERS
    // =========================

    public function orders()
    {
        // LOGIN

        if(!session()->has('user_id'))
        {
            return redirect('/login');
        }

        // ORDERS

        $orders = Order::where(
            'user_id',
            session('user_id')
        )
        ->latest()
        ->get();

        return view(
            'orders',
            compact('orders')
        );
    }

    // =========================
    // ORDER DETAIL
    // =========================

    public function orderDetail($id)
    {
        // ORDER

        $order = Order::with([

            'items.product',

            'cards.userCard.pokemonCard',

            'location'

        ])->find($id);

        // SECURITY

        if(
            $order->user_id
            != session('user_id')
        )
        {
            return redirect('/orders');
        }

        return view(
            'order-detail',
            compact('order')
        );
    }
}