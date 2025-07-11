<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class ServicesPageController extends Controller
{
    public function index()
    {
        return Inertia::render('Services/ServicesPage');
    }
}
