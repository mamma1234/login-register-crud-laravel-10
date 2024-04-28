<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;
use App\Services\TwentyFourService;
use Exception;

class ManageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('manage.manage', [
            'orders' => null
        ]);
    }

    public function getAddr(Request $request)
    {
        $data = (new TwentyFourService)->getAddr($request->sido, $request->gugun);
        $result = implode(', ', array_column($data, 'nm'));
        return response()->json(['message' => $result], 200);
    }
}
