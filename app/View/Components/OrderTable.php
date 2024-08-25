<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Order;

class OrderTable extends Component
{
    public $orderStatus;
    public $search;
    public $orderDate;
    public $sortOrder;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->orderStatus = request()->input('order_status');
        $this->search = request()->input('search');
        $this->orderDate = request()->input('order_date', now()->toDateString());
        $this->sortOrder = request()->input('sort_order', 'asc'); // Default to ascending order
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $query = Order::query();

        // Main filter by order_date
        $query->whereDate('created_at', $this->orderDate);

        // Apply order_status filter under order_date
        if ($this->orderStatus) {
            $query->where('order_status', $this->orderStatus);
        }

        // Apply search filter under order_date
        if ($this->search) {
            $searchTerm = strtolower($this->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(customer_name) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(order_number) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(customer_phone_number) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        // Apply sorting
        $orders = $query->orderBy('created_at', $this->sortOrder)->paginate(10);

        // Append query parameters to pagination links
        $orders->appends([
            'order_status' => $this->orderStatus,
            'search' => $this->search,
            'sort_order' => $this->sortOrder,
            'order_date' => $this->orderDate,
        ]);

        return view('components.order-table', compact('orders'));
    }
}
