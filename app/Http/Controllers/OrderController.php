<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function create()
    {
        return view('orders.create');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => ['required'],
        ]);

        $order->update(['order_status' => $request->status]);

        return response()->json(['success' => true]);
    }
}
