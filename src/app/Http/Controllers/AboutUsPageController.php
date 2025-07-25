<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class AboutUsPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('AboutUs/AboutUsPage');
    }
}
