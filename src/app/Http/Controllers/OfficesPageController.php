<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class OfficesPageController extends Controller
{
    public function index()
    {
        return Inertia::render('Offices/OfficesPage');
    }
}
