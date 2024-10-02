<?php

namespace App\Http\Controllers\ServiceProvider;

use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class ProviderController extends Controller
{
      // service provider registration request
      public function store(Request $request)
      {
          \Log::info('ServiceProviderController store method called');
          \Log::info($request->all());
  
          $validator = Validator::make($request->all(), [
              'business_name' => 'required|string|max:255',
              'business_license_no' => 'required|string|max:255|unique:service_providers',
              'contact_no' => 'required|string|max:20',
              'email' => 'required|string|email|max:255|unique:service_providers',
             'password' => ['required','string',
                  Password::min(8)
                  ->mixedCase()
                  ->letters()
                  ->numbers()
                  ->symbols()
                  ->uncompromised(),],
          ]);
  
          if ($validator->fails()) {
              return response()->json([
                  'status' => 'error',
                  'message' => "There were errors with your submission\n" . implode("\n", $validator->errors()->all()),
              ], 400);
          }
  
          try {
              ServiceProvider::create([
                  'business_name' => $request->business_name,
                  'business_license_no' => $request->business_license_no,
                  'contact_no' => $request->contact_no,
                  'email' => $request->email,
                  'password' => bcrypt($request->password),
              ]);
  
              return response()->json([
                  'status' => 'success',
                  'message' => 'Approval Request Sent Successfully.',
              ]);
  
          } catch (QueryException $e) {
              \Log::error('Error occurred during ServiceProvider creation: ' . $e->getMessage());
  
              if ($e->getCode() === '23000') { 
                  return response()->json([
                      'status' => 'error',
                      'message' => 'The Contact No is already taken. Please use a different one.',
                  ], 400);
              }
  
              // General error response
              return response()->json([
                  'status' => 'error',
                  'message' => 'An unexpected error occurred. Please try again later.',
              ], 500);
          }
      }
  
  
      // service provider login
public function providerlogin(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string',
    ]);

    $serviceProvider = ServiceProvider::where('email', $request->email)->first();

    if ($serviceProvider) {
        if ($serviceProvider->status === 'approved') {
            if (Hash::check($request->password, $serviceProvider->password)) {
                Auth::login($serviceProvider);
                $businessName = $serviceProvider->business_name;
                return response()->json([
                    'status' => 'success',
                    'message' => 'Logged in successfully!',
                    'business_name' => $businessName,
                ], 200);
            } else {
                return response()->json(['status' => 'error', 'message' => 'The provided password is incorrect.'], 400);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'The account is not approved.'], 400);
        }
    } else {
        return response()->json(['status' => 'error', 'message' => 'No account found with the provided email.'], 400);
    }
}


  
      // service provider logout
      public function providerlogout(Request $request)
      {
          Auth::logout();
  
          $request->session()->invalidate();
          $request->session()->regenerateToken();
  
          return redirect()->route('frontpage');
      }

}
