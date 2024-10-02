<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceType;

class ServiceTypesController extends Controller
{

    // create service type
    public function create()
    {
        return view('admin.addServiceType');
    }

    // Store service type
    public function store(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('service_images');
                $image->move($destinationPath, $imageName);
                $imagePath = 'service_images/' . $imageName;
            }
    
            ServiceType::create([
                'name' => $request->name,
                'description' => $request->description,
                'image' => $imagePath ?? null,
            ]);
    
            return redirect()->route('viewservicetypes')->with('success', 'Service Type added successfully!');
    
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    

    // view service type
    public function index()
    {
        $serviceTypes = ServiceType::all();
        return view('admin.servicetypes', compact('serviceTypes'));
    }

    public function edit($service_type_id)
    {
        // Retrieve the service type by its ID
        $serviceType = ServiceType::findOrFail($service_type_id);

        // Pass the retrieved service type to the view
        return view('admin.editServiceType', compact('serviceType'));
    }

    public function update(Request $request, $service_id)
    {
        try {
            $serviceType = ServiceType::findOrFail($service_id);

            // Check if a new image is uploaded
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $destinationPath = public_path('service_images');
                $image->move($destinationPath, $imageName);
                $imagePath = 'service_images/' . $imageName;

                // Update the image path in the service type
                $serviceType->image = $imagePath;
            }

            // Update other fields
            $serviceType->name = $request->name;
            $serviceType->description = $request->description;

            // Save the changes
            $serviceType->save();

            return redirect()->route('viewservicetypes')->with('success', 'Service Type updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }


    // delete service type
    public function destroy ($service_type_id)
    {
        $serviceType = ServiceType::findOrFail($service_type_id);
        $serviceType->delete();
        return redirect()->route('viewservicetypes')->with('success', 'Subservice deleted successfully!');

    }

}
