<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        /**
        List all orders in the system for products on the logged in user account and allow for navigation within the set
        Display the Order - customer name, email address, product name, color, size, order_status, order total, transaction id, shipper (if applicable), tracking number (if applicable)
        Show a total of sales for all orders
        Show the average sale total across all orders

         */


        $avgResults = DB::table("orders")
            ->join("products", 'products.id', '=', 'orders.product_id')
            ->join("inventory_items", 'inventory_items.id', '=', 'orders.inventory_id')
            ->select(DB::raw('sum(orders.total_cents) as total_sales, count(*) as order_count'))
            ->where('products.admin_id', '=', $user->id)
            ->first();

        $total_sales = $avgResults->total_sales * 100;
        if ($avgResults->order_count > 0) {
            $avg_sales = sprintf("%.2f", $total_sales / $avgResults->order_count);
        } else {
            $avg_sales = 0;
        }

        $orders = DB::table("orders")
            ->join("products", 'products.id', '=', 'orders.product_id')
            ->join("inventory_items", 'inventory_items.id', '=', 'orders.inventory_id')
            ->select("orders.id", "name", "email", "products.product_name", "inventory_items.color", "inventory_items.size", "orders.order_status", "orders.total_cents", "orders.transaction_id", "orders.tracking_number", "orders.shipper_name", "orders.tracking_number")
            ->where('products.admin_id', '=', $user->id)
            ->paginate(20);

        return Inertia::render('Orders/Index', [
            'orders' => $orders,
            'total_sales' => $total_sales,
            'avg_sales' => $avg_sales,
            'order_count' => $avgResults->order_count,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
