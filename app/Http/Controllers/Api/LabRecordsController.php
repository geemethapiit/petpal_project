<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pets;
use App\Models\LabRecords;
use Illuminate\Support\Facades\Auth;

class LabRecordsController extends Controller
{
    // send list of lab records

    public function list($pet_id)
    {
        try
        {
            $pet = Pets::where('petowner_id', Auth::id())
            ->where('pet_id', $pet_id)
            ->first();

            if (!$pet) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pet not found or not owned by the user'
                ], 404);
            }

            $labRecords = LabRecords::where('pet_id', $pet_id)->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Lab records retrieved successfully',
                'data' => $labRecords
            ], 200);

        }
        catch (\Throwable $th) 
        {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
