<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PaymentsPageController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Payments/PaymentsPage');
    }
}
