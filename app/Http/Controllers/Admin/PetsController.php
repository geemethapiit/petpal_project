<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pets;

class PetsController extends Controller
{
    // create service type
    public function index()
    {
        $pets = pets::all();
        return view('admin.pets', compact('pets'));
    }
}
