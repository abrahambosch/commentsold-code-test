<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        // Provide a list of products tied to the user account
        // name, style, brand, (optionally) available sku’s
        // (optionally) Allow the user to create a new product, edit an existing product or delete a product
        $user = $request->user();

        $skuQuery = DB::table("products")
        ->leftJoin("inventory_items", 'products.id', '=', 'inventory_items.product_id')
        ->select(DB::raw('GROUP_CONCAT(inventory_items.sku) as skus, sum(price_cents * quantity) as revenue, products.id'))
        ->where('products.admin_id', '=', $user->id)
        ->groupBy('id');

        $productsQuery = Product::where('admin_id', $user->id)->leftJoinSub($skuQuery, "skus", function ($join) {
            $join->on('products.id', '=', 'skus.id');
        });
        //echo $productsQuery->toSql(); die;
        $products = $productsQuery->paginate(20);

        return Inertia::render('Products/Index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Products/Create', [
            'product' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'style' => 'required|string',
            'brand' => 'required|string',
            'url' => 'required|url|nullable|max:255',
            'product_type' => 'required|string|max:255',
            'shipping_price' => 'required|integer',
            'note' => 'required|nullable|string',
        ]);

        $product = new Product();
        $product->admin_id = $request->user()->id;
        $product->product_name = $data['product_name'];
        $product->description = $data['description'];
        $product->style = $data['style'];
        $product->brand = $data['brand'];
        $product->url = $data['url'];
        $product->product_type = $data['product_type'];
        $product->shipping_price = $data['shipping_price'];
        $product->note = $data['note'];
        $product->save();




        return redirect()->route('products.index')->with('message', 'Product Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return Inertia::render('Products/Edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'style' => 'required|string',
            'brand' => 'required|string',
            'url' => 'required|nullable|url|max:255',
            'product_type' => 'required|string|max:255',
            'shipping_price' => 'required|integer',
            'note' => 'required|nullable|string',
        ]);

        $product->product_name = $data['product_name'];
        $product->description = $data['description'];
        $product->style = $data['style'];
        $product->brand = $data['brand'];
        $product->url = $data['url'];
        $product->product_type = $data['product_type'];
        $product->shipping_price = $data['shipping_price'];
        $product->note = $data['note'];
        $product->save();

        return redirect()->route('products.index')->with('message', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('message', 'Product Deleted Successfully');
    }
}
