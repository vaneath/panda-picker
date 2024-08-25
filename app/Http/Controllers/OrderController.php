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
    private $telegramApiUrl;

    public function __construct()
    {
        $this->telegramApiUrl = "https://api.telegram.org/bot" . env('BOT_TOKEN') . "/sendMessage";
    }

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

        $order = Order::create($attributes);

        $this->notifyTelegram($order, $this->getSuccessMessage($order));
        $this->sendInstruction($order);

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

    private function notifyTelegram(Order $order, string $message)
    {
        $response = Http::post($this->telegramApiUrl, [
            'chat_id' => $order->customer_chat_id,
            'text' => $message,
            'parse_mode' => 'HTML',
        ]);

        if (!$response->successful()) {
            Log::error('Failed to send Telegram message', ['order_id' => $order->id, 'response' => $response->body()]);
            return response()->json(['success' => false], 500);
        }

        return response()->json(['success' => true]);
    }

    private function getSuccessMessage(Order $order): string
    {
        return "ការកម្មង់របស់បងមានលេខសម្គាល់ <b>{$order->order_number}</b> បានទទួលជោគជ័យ។ ដើម្បីជាការងាយស្រួលក្នុងការផ្ដល់ដំណឹងជូនអ្នកដឹកជញ្ជូនម្ហូប បងអាច <b>Copy</b> សារខាងក្រោមនេះផ្ញើរទៅអ្នកដឹកជញ្ជូនផ្ទាល់ នៅពេលដែលគាត់មកដល់:";
    }

    public function sendInstruction(Order $order)
    {
        $message = "សួស្ដីបង សូមជួយយកម្ហបមកកាន់ពីមុខអគារ GIA Tower នឹងមានអ្នកចាំទទួលនៅខាងមុខនោះ។​ នេះជាលេខទំនាក់ទំនង 092 311 364។";
        return $this->notifyTelegram($order, $message);
    }

    public function notify(Order $order)
    {
        $message = $this->getMessageBasedOnStatus($order);
        return $this->notifyTelegram($order, $message);
    }

    private function getMessageBasedOnStatus(Order $order): string
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
