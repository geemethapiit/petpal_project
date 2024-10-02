<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceType;

class ServiceTypeController extends Controller
{
    // display service types

    public function list()
    {
        $serviceTypes = ServiceType::all();
        return response()->json([
            'status' => 200,
            'serviceTypes' => $serviceTypes
        ]);
    }
}
