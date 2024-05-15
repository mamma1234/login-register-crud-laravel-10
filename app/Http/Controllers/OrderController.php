<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Services\TwentyFourService;
use Exception;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $orders = Order::leftjoin('dispatches', 'dispatches.order_id', 'orders.id')
            ->select([
                'orders.*',
                'dispatches.car_number as dispatch_car_number',
                'dispatches.car_ton as dispatch_car_ton',
                'dispatches.car_type as dispatch_car_type',
                'dispatches.car_load_option as dispatch_car_load_option'
            ])
            ->where('orders.user_id', $userId)
            ->get();

        // Log::debug($orders);

        return view('order.order', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.order-add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'start_address_siNm' => 'required',
            'start_address_sggNm' => 'required',
            'start_address_emdNm' => 'required',
            'start_address_detail' => 'required',
            'end_address_siNm' => 'required',
            'end_address_sggNm' => 'max:1000',
            'end_address_emdNm' => 'max:1000',
            'end_address_detail' => 'max:1000',
        ]);

        Log::debug($request->all());
        
        $userId = Auth::id();
        $order = Order::create(array_merge($request->all(), ['user_id' => $userId]));

        try {
            $response = (new TwentyFourService)->setOrder($order->id);
            Log::debug($response);
            $order->update([
                'twentyfour_order_no' => $response['ordNo'],
                'twentyfour_error_msg' => null
            ]);
        } catch (Exception $e) {
            \Log::error($e->getMessage());
            $order->update([
                'twentyfour_error_msg' => $e->getMessage(),
            ]);
        }

        Alert::success('Success', '(' .$order->id . ') Order has been saved ! ');
        return redirect('/order');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $order = Order::leftjoin('dispatches', 'dispatches.order_id', 'orders.id')
            ->where('orders.id', $id)
            ->select([
                'orders.*',
                'dispatches.car_number as dispatch_car_number',
                'dispatches.car_ton as dispatch_car_ton',
                'dispatches.car_type as dispatch_car_type',
                'dispatches.car_load_option as dispatch_car_load_option'
            ])
            ->firstOrFail();

        return view('order.order-edit', [
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'start_address_siNm' => 'required',
            'start_address_sggNm' => 'required',
            'start_address_emdNm' => 'required',
            'start_address_detail' => 'required',
            'end_address_siNm' => 'required',
            'end_address_sggNm' => 'max:1000',
            'end_address_emdNm' => 'max:1000',
            'end_address_detail' => 'max:1000',
        ]);
        Log::debug($request->all());

        $order = Order::findOrFail($id);
        // $order->update($validated);
        $order->update($request->all());

        if ( empty($order->twentyfour_order_no) ) {
            try {
                $response = (new TwentyFourService)->setOrder($order->id);
                Log::debug($response);
                $order->update([
                    'twentyfour_order_no' => $response['ordNo'],
                    'twentyfour_error_msg' => null
                ]);
            } catch (Exception $e) {
                \Log::error($e->getMessage());
                $order->update([
                    'twentyfour_error_msg' => $e->getMessage(),
                ]);
            }
        }
        
        Alert::info('Success', '(' .$order->id . ') Order has been updated !');
        return redirect('/order');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $deletedorder = Order::findOrFail($id);
            $deletedorder->delete();

            Alert::error('Success', '(' .$deletedorder
            ->id . ') Order has been deleted !');
            return redirect('/order');
        } catch (Exception $ex) {
            Alert::warning('Error', 'Cant deleted, Order already used !');
            return redirect('/order');
        }
    }

    public function orders()
    {
        $orders = Order::all();
        return response()->json($orders);
    }
}
