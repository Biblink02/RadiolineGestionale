<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ContactUsPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Contact/ContactUs');
    }
}
