<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\petowners;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class petownersController extends Controller
{
    // petowner registration
    public function register(Request $request)
    {
      try
      {
        $validateUser = Validator::make($request->all(), 
        [
          'name' => 'required',
          'email' => 'required|email|unique:petowners,email',
          'password' => 'required',
        ]);

        if($validateUser->fails())
        {
          return response()->json([
            'status' => 'error',
            'message' => 'Validation Error',
            'errors' => $validateUser->errors(),
          ], 401);
        }

        $petowner = petowners::create([
          'name' => $request->name,
            'address' => '',
            'phone' => '',
          'email' => $request->email,
          'password' => Hash::make($request->password),
        ]);

        return response()->json([
          'status' => 'success',
          'message' => 'Petowner registered successfully',
          'user_id' => $petowner->petowner_id,
          'token' => $petowner->createToken("API TOKEN")->plainTextToken,
        ] , 200);
        
      }
        catch(Exception $e)
        {
            return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while registering petowner',
            ], 500);
        }
    }




    // petowner login
    public function login(Request $request)
    {
      try
      {
        $validateUser = Validator::make($request->all(), 
        [
          'email' => 'required|email',
          'password' => 'required',
        ]);

        if($validateUser->fails())
        {
          return response()->json([
            'status' => 'error',
            'message' => 'Validation Error',
            'errors' => $validateUser->errors(),
          ], 401);
        }

        $petowner = petowners::where('email', $request->email)->first();

        if(!$petowner || !Hash::check($request->password, $petowner->password))
        {
          return response()->json([
            'status' => 'error',
            'message' => 'Invalid email or password',
          ], 401);
        }

        return response()->json([
          'status' => 'success',
          'message' => 'Petowner logged in successfully',
          'user_id' => $petowner->petowner_id,
          'token' => $petowner->createToken("API TOKEN")->plainTextToken,
        ] , 200);
        
      }
        catch(Exception $e)
        {
            return response()->json([
            'status' => 'error',
            'message' => 'An error occurred while logging in petowner',
            ], 500);
        }
    }
}
