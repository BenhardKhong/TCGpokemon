<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class MarketplaceController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        return view(
            'marketplace',
            compact('products')
        );
    }

    // ===== Admin: show add product form =====
    public function create()
    {
        if(!session('is_admin')) return redirect('/');

        return view('admin.product-create');
    }

    // ===== Admin: store new product =====
    public function store(Request $request)
    {
        if(!session('is_admin')) return redirect('/');

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|string'
        ]);

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'image' => $request->image
        ]);

        return redirect('/marketplace')->with('success','Product added');
    }

    public function edit($id)
    {
        if(!session('is_admin')) return redirect('/');

        $product = Product::find($id);

        return view('admin.product-edit', compact('product'));
    }

    public function update(Request $request,$id)
    {
        if(!session('is_admin')) return redirect('/');

        $product = Product::find($id);

        $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'required|string'
        ]);

        $product->update($request->only(['name','description','price','stock','image']));

        return redirect('/marketplace')->with('success','Product updated');
    }

    public function destroy($id)
    {
        if(!session('is_admin')) return redirect('/');

        Product::find($id)?->delete();

        return redirect('/marketplace')->with('success','Product deleted');
    }
}