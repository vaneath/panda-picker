<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Enums\OrderStatusEnum;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orderStatus = $request->input('order_status');
        $search = $request->input('search');

        return view('dashboard', compact('orderStatus', 'search'));
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

    public function notify(Order $order)
    {
        $chatId = $order->customer_chat_id;
        $message = $this->getMessageBasedOnStatus($order);

        $response = Http::post("https://api.telegram.org/bot" . env('BOT_TOKEN') . "/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
        ]);

        if ($response->successful()) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 500);
        }
    }

    private function getMessageBasedOnStatus($order)
    {
        $customerName = $order->customer_name;
        $floor = $order->floor;
        $orderNumber = $order->order_number;

        return match ($order->order_status) {
            OrderStatusEnum::WAITING => 'សួស្ដីបង ' . $customerName . ' ការកម្មង់របស់បងដែលមានលេខសម្គាល់ ' . $orderNumber . ' កំពុងស្ថិតក្នុងការរង់ចាំ សូមអរគុណ។',
            OrderStatusEnum::PREPARING => 'សួស្ដីបង ' . $customerName . ' ការកម្មង់របស់បងដែលមានលេខសម្គាល់ ' . $orderNumber . ' កំពុងតែរៀបចំយកទៅជាន់ទី ' . $floor . ' សូមរង់ចាំទទួល សូមអរគុណ។',
            OrderStatusEnum::DONE => 'សួស្ដីបង ' . $customerName . ' ការកម្មង់របស់បងដែលមានលេខសម្គាល់ ' . $orderNumber . ' បានមកដល់ជាន់ទី ' . $floor . ' សូមបងអញ្ជើញមកទទួល សូមអរគុណ។',
            default => '',
        };
    }
}
