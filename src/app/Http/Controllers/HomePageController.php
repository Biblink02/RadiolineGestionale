<?php

namespace App\Http\Controllers;

use App\Services\SchemaGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Inertia\Inertia;

class HomePageController extends Controller
{
    public function index()
    {
        Log::info(SchemaGenerator::for('home'));
        return Inertia::render('Home/HomePage');
    }
}
