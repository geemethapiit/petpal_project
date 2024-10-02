<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubService;
use App\Models\ServiceType;


class SubServiceController extends Controller
{

    // display sub service page 
    public function index()
    {
    $subservices = SubService::with('serviceType')->get();
    $serviceTypes = ServiceType::all();
    return view('admin.subService', compact('subservices', 'serviceTypes'));
    }

    // add sub service page 
    public function create()
    {
    $serviceTypes = ServiceType::all();
    return view('admin.addSubService', compact('serviceTypes'));
    }


    //  store sub service
    public function store(Request $request)
    {
    $request->validate([
        'service_type_id' => 'required|exists:servicetypes,service_type_id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
    ]);
    SubService::create([
        'service_type_id' => $request->service_type_id,
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
    ]);
    return redirect()->route('viewsubservices')->with('success', 'Subservice added successfully!');
    }

    // edit sub service page
    public function edit($subservice_id)
    {
        $subservice = SubService::findOrFail($subservice_id);
        $serviceTypes = ServiceType::all(); 
        return view('admin.editSubService', compact('subservice', 'serviceTypes'));
    }


    // update sub service
    public function update(Request $request, $subservice_id)
    {
        $request->validate([
            'service_type_id' => 'required|exists:servicetypes,service_type_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
        ]);
        $subservice = SubService::findOrFail($subservice_id);
        $subservice->update([
            'service_type_id' => $request->service_type_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);
        return redirect()->route('viewsubservices')->with('success', 'Subservice updated successfully!');
    }


    // delete sub service
    public function destroy($id)
    {
        $subservice = SubService::findOrFail($id);
        $subservice->delete();
        return redirect()->route('viewsubservices')->with('success', 'Subservice deleted successfully!');
    }

}
