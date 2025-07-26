<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class RadioRentPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('RadioRent/RadioRentPage');
    }
}
