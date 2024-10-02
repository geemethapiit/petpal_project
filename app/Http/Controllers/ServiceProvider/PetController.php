<?php

namespace App\Http\Controllers\ServiceProvider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\pets;

class PetController extends Controller
{
    // create service type
    public function index()
    {
        $pets = pets::all();
        return view('provider.pets', compact('pets'));
    }
}
