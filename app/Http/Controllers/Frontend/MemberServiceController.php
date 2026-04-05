<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberServiceController extends Controller
{
    public function index()
    {
        $services = \App\Models\Service::all();
        return view('frontend.user.services.index', compact('services'));
    }
}
