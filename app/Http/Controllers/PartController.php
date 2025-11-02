<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Part;
use Inertia\Inertia;

class PartController extends Controller
{
    public function index()
    {
        $parts = Part::with('car')->orderBy('created_at', 'desc')->get();
        return Inertia::render('Parts', [
            'parts' => $parts
        ]);
    }
}
