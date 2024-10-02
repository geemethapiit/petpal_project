<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\admin_details;
use App\Models\ServiceProvider;
use App\Models\ServiceType;
use App\Models\pets;
use App\Models\petowners;

class AdminController extends Controller
{
        // admin registration 
        public function adminregister(Request $request)
        {
            \Log::info($request->all());
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:admin_details',
                'password' => 'required|string|min:6|confirmed',
            ]);
        
            $admin = admin_details::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);
        
        
            return redirect()->route('viewadmindashboard');
        }
    
    

        // Admin login 
        public function adminlogin(Request $request)
        {  
            \Log::info($request->all());

            // Validate the request
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            // Attempt to retrieve the user
            $adminUser = admin_details::where('email', $request->email)->first();

            if ($adminUser) {
                \Log::info('User retrieved: ' . $adminUser->email);
                \Log::info('Stored password: ' . $adminUser->password);

                if (password_verify($request->password, $adminUser->password)) {
                    Auth::login($adminUser, $request->has('remember'));
                    \Log::info('Authenticated user: ' . $adminUser->email);
                    return redirect()->route('viewadmindashboard');
                }
            }

            \Log::warning('Login failed for: ' . $request->email);
            return redirect()->back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }


        
        // admin logout
        public function logout(Request $request)
        {
            try 
            {
            \Log::info('Admin logging out'); 
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('frontpage');
            } catch (\Exception $e) {
                \Log::error('Logout error: ' . $e->getMessage());
                return redirect()->back()->withErrors(['error' => 'Logout failed.']);
            }
        }   



        //display pending requests
        public function dashboard()
        {

        $servicetypes = ServiceType::count();
        $petowners = petowners::count();
        $pets = pets::count();
        $serviceproviders = ServiceProvider::where('status', 'approved')->count();
        $pendingrequests = ServiceProvider::where('status', 'pending')->get();
        return view('admin.admindashboard', compact('pendingrequests', 'servicetypes', 'serviceproviders', 'petowners', 'pets'));
        }


        // approve request
        public function approve(Request $request)
        {
            \Log::info($request->all());
            
            $request->validate([
                'id' => 'required|exists:service_providers,provider_id',
                'status' => 'required|string'
            ]);
        
            $updated = ServiceProvider::where('provider_id', $request->id)
                        ->update(['status' => $request->status]);
        
            if ($updated) {
                return redirect()->route('viewadmindashboard')->with('success', ucfirst($request->status) . ' successfully.');
            } else {
                return redirect()->route('viewadmindashboard')->with('error', 'Failed to update status.');
            }
        }
        

        // reject request
        public function reject(Request $request)
        {
            \Log::info($request->all());
            
            $request->validate([
                'id' => 'required|exists:service_providers,provider_id',
                'status' => 'required|string'
            ]);
        
            $updated = ServiceProvider::where('provider_id', $request->id)
                        ->update(['status' => $request->status]);
        
            if ($updated) {
                return redirect()->route('viewadmindashboard')->with('success', ucfirst($request->status) . ' successfully.');
            } else {
                return redirect()->route('viewadmindashboard')->with('error', 'Failed to update status.');
            }
        }
    
}
