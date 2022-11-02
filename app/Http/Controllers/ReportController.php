<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function render()
    {
        return view('frontend.create');
    }

    public function view()
    {
        return view('frontend.show');
    }
}
