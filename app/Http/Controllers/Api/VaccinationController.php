<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pets;
use App\Models\Vaccination;
use Illuminate\Support\Facades\Auth;

class VaccinationController extends Controller
{
    //vaccination records display

    public function list($pet_id)
    {
        try {
            // Find the pet and check if it belongs to the authenticated user
            $pet = Pets::where('pet_id', $pet_id)
                ->where('petowner_id', Auth::id())
                ->first();

            if (!$pet) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pet not found or not owned by the user'
                ], 404);
            }

            // Retrieve vaccination records for the pet
            $vaccinations = Vaccination::where('pet_id', $pet_id)->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Vaccination records retrieved successfully',
                'data' => $vaccinations
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
