<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TempPageController extends Controller
{
    public function index(Request $req){
        return Inertia::render('Temp');
    }
}
