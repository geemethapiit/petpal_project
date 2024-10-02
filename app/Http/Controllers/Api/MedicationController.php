<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\Medications;
use Illuminate\Support\Facades\Auth;

class MedicationController extends Controller
{
    // display medication records

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

            $medications = Medications::where('pet_id', $pet_id)->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Medication records retrieved successfully',
                'data' => $medications
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
