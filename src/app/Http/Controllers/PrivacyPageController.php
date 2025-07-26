<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PrivacyPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Privacy/PrivacyPage');
    }
}
