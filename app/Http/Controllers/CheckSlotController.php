<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckSlotController extends Controller
{
    public function index()
    {
        return view('frontend.check-slot.index');
    }
}
