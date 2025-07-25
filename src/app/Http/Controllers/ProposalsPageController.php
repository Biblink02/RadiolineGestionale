<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ProposalsPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Proposals/ProposalsPage');
    }
}
