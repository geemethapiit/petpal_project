<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ServiceProviderController extends Controller
{
    // view for service providers
    public function index()
    {
        $approvedProviders = ServiceProvider::where('status', 'approved')->get();

        return view('admin.serviceproviders', compact('approvedProviders'));
    }

    // remove service provider
    public function remove($id)
    {
    $provider = ServiceProvider::find($id);

    if ($provider) {
        $provider->delete();
        return redirect()->back()->with('success', 'Service Provider removed successfully.');
    }

    return redirect()->back()->with('error', 'Service Provider not found.');
    }

    // create service type
    public function create()
    {
        return view('admin.addServiceProvider');
    }


    // store service provider
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
  
              return redirect()->route('viewserviceproviders')->with('success', 'Service Provider added successfully!');
  
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
}
