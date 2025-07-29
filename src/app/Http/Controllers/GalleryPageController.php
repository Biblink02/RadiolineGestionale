<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class GalleryPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Gallery/GalleryPage');
    }
}
