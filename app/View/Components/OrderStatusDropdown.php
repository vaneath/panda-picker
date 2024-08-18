<?php
namespace App\View\Components;

use Illuminate\View\Component;

class OrderStatusDropdown extends Component
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function render()
    {
        return view('components.order-status-dropdown');
    }
}
