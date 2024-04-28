<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use Exception;

class DispatchController extends Controller
{
    public function dispatches()
    {
        $dispatches = Dispatch::all();
        return response()->json($dispatches);
    }

    public function twentyFour(Request $request)
    {
        Log::debug($request->all());
        $order = Order::where('twentyfour_order_no', $request->ordNo)->first();
        $dispatch = Dispatch::updateOrCreate(
            [   
                "order_id" => $order->id
            ],
            [
                "car_number" => $request->cjCarNum,
                "car_ton" => $request->cjCargoTon,
                "car_type" => $request->cjTruckType,
                "car_load_option" => $request->cjLoadOption,
            ]
        );
        return response()->json([], 200);
    }
}
