<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Model\MySql\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class Export implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        $id = session()->get('order_export_id');
        $order = Order::find($id);
        $order->load('details', 'shipping');
        session()->forget('order_export_id');
        return view('exports.order', [
            'order' => $order
        ]);
    }
}
