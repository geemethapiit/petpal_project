<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class PetsController extends Controller
{
    // pets registration 

    public function register(Request $request)
    {
        try
        {
            $request->validate([
                'registration_number' => 'required|unique:pets',
                'name' => 'required|String',
                'type' => 'required|String',
                'breed' => 'required|String',
                'age' => 'required|integer',
                'color' => 'required |String',
                'gender' => 'required|String',
                'special_notes' => 'nullable|String',
            ]);

    
            $pet = pets::create([
                'registration_number' => $request->registration_number,
                'name' => $request->name,
                'type' => $request->type,
                'breed' => $request->breed,
                'age' => $request->age,
                'color' => $request->color,
                'gender' => $request->gender,
                'special_notes' => $request->special_notes ?? '',
                'petowner_id' => Auth::id(),
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Pet registered successfully',
                'data' => $pet,
            ], 200);

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }



    // pets update
    public function update(Request $request, $id)
    {
        try
        {
            $pet = pets::find($id);

            if(!$pet || $pet->petowner_id != Auth::id())
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pet not found or unauthorized',
                ], 404);
            }

            $request->validate([
                'registration_number' => 'required|string',
                'name' => 'required|string',
                'type' => 'required|string',
                'breed' => 'required|string',
                'age' => 'required|integer',
                'color' => 'required|string',
                'gender' => 'required|string',
                'special_notes' => 'nullable|string',
            ]);

            $pet->update($request->all());

            
            return response()->json([
                'status' => 'success',
                'message' => 'Pet updated successfully',
                'data' => $pet,
            ], 200);

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }



    // pets delete
    public function delete($id)
    {
        try
        {
            $pet = pets::find($id);

            if(!$pet || $pet->petowner_id != Auth::id())
            {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pet not found or unauthorized',
                ], 404);
            }

            $pet->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Pet deleted successfully',
            ], 200);

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }


    // pets list
    public function list()
    {
        try
        {
            $pets = pets::where('petowner_id', Auth::id())->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Pets retrieved successfully',
                'data' => $pets,
            ], 200);

        }
        catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    // pets name list
    public function nameList()
    {
        try
            {
                $pets = pets::where('petowner_id', Auth::id())
                            ->select('pet_id', 'name')
                            ->get();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Pets retrieved successfully',
                    'data' => $pets,
                ], 200);
            }
        catch 
            (\Throwable $th) {
                return response()->json([
                    'status' => 'error',
                    'message' => $th->getMessage()
                ], 500);
            }
    }
}