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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'customer_phone_number' => 'required|string|max:255',
            'floor' => 'required|integer|min:1|max:50',
            'customer_chat_id' => 'nullable|string|max:255',
        ]);

        Order::create($validated);

        return redirect()->back()->with('success', 'Form submitted successfully.');
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
