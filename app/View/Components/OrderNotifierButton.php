<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OrderNotifierButton extends Component
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function render(): View|Closure|string
    {
        return view('components.order-notifier-button');
    }
}
