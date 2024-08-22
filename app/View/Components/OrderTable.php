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
    public $sortOrder;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->orderStatus = request()->input('order_status');
        $this->search = request()->input('search');
        $this->sortOrder = request()->input('sort_order', 'asc'); // Default to ascending order
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $query = Order::query();

        if ($this->orderStatus) {
            $query->where('order_status', $this->orderStatus);
        }

        if ($this->search) {
            $searchTerm = strtolower($this->search);
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('LOWER(customer_name) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(order_number) LIKE ?', ["%{$searchTerm}%"])
                  ->orWhereRaw('LOWER(customer_phone_number) LIKE ?', ["%{$searchTerm}%"]);
            });
        }

        $orders = $query->orderBy('created_at', $this->sortOrder)->paginate(10);

        $orders->appends([
            'order_status' => $this->orderStatus,
            'search' => $this->search,
            'sort_order' => $this->sortOrder,
        ]);

        return view('components.order-table', compact('orders'));
    }
}
