<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class TesController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Tes/Index');
    }
}
