<?php

namespace App\Http\Controllers;

use App\Models\Dispatch;
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
    }
}
