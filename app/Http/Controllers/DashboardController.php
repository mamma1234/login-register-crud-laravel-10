<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::count();

        return view('dashboard.dashboard', [
            'order' => $order,
        ]);
    }
}
