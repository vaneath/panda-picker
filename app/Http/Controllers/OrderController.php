<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Enums\OrderStatusEnum;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

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
        $attributes = $request->validate([
            'order_number' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'customer_phone_number' => 'required|string|max:255',
            'floor' => 'required|integer|min:1|max:50',
            'customer_chat_id' => 'nullable|string|max:255',
            'order_summary' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('order_summary')) {
            $attributes['order_summary'] = $request->file('order_summary')->storePublicly('orders');
        }

        Order::create($attributes);

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
            'parse_mode' => 'HTML',
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
        OrderStatusEnum::WAITING => "**<b>ស្ថិតក្នុងការរង់ចាំ</b>** សួស្ដីបង <b>{$customerName}</b> ការកម្មង់របស់បងដែលមានលេខសម្គាល់ <b>{$orderNumber}</b> កំពុងស្ថិតក្នុងការរង់ចាំ សូមអរគុណ។ ⏰",
        OrderStatusEnum::PREPARING => "**<b>កំពុងរៀបចំយកទៅលើ</b>** សួស្ដីបង <b>{$customerName}</b> ការកម្មង់របស់បងដែលមានលេខសម្គាល់ <b>{$orderNumber}</b> កំពុងតែរៀបចំយកទៅជាន់ទី <b>{$floor}</b> សូមរង់ចាំទទួល សូមអរគុណ។ 🏃",
        OrderStatusEnum::DONE => "**<b>ការកម្មង់បានមកដល់</b>** សួស្ដីបង <b>{$customerName}</b> ការកម្មង់របស់បងដែលមានលេខសម្គាល់ <b>{$orderNumber}</b> បានមកដល់ជាន់ទី <b>{$floor}</b> សូមបងអញ្ជើញមកទទួល សូមអរគុណ។ 🎉",
        default => '',
    };
}
}
