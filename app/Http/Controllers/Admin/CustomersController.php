<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\petowners;

class CustomersController extends Controller
{
    // function to return the customers view
    public function index(){

        $petowners = petowners::all();
        return view('admin.customers', compact('petowners'));
    }

    // function to remove a customer
    public function destory($id){
        $petowner = petowners::find($id);

        if($petowner){
            $petowner->delete();
            return redirect()->back()->with('success', 'Customer removed successfully.');
        }

        return redirect()->back()->with('error', 'Customer not found.');
    }

    // function to edit a customer
    public function edit($id){
        $petowner = petowners::find($id);

        if($petowner){
            return view('admin.editcustomer', compact('petowner'));
        }

        return redirect()->back()->with('error', 'Customer not found.');
    }
}
