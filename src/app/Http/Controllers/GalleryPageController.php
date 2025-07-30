<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\File;

class GalleryPageController extends Controller
{
    public function index(): Response
    {
//        $path = public_path('images/gallery');
//        $files = File::files($path);
//        $imgNumber = count($files);

        return Inertia::render('Gallery/GalleryPage', [
            'imgNumber' => config('custom.gallery.imgNumber'),
            'batchSize' => config('custom.gallery.batchSize'),
        ]);

    }
}
