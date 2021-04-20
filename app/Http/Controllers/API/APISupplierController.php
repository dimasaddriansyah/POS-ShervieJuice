<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class APISupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::get();

        return response()->json(['message' => 'Success', 'data' => $suppliers]);
    }
}
