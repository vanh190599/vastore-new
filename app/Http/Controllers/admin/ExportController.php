<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Exports\Export;
use App\Model\MySql\Order;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportOrder($id){
        /*
        $order = Order::find($id);
        $order->load('details', 'shipping');
        return view('exports.order', compact('order'));
        */

        session()->put('order_export_id', $id);
        $order = Order::find($id);
        $order->load('shipping');
        $name = isset($order->shipping->receive) ? $order->shipping->receive : '';
        $file_name = 'Hóa đơn của '.$name.'_'.$order->id;

        return Excel::download(new Export(), $file_name.'.xlsx');
    }
}
