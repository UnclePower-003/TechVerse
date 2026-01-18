<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactHero;
use App\Models\ContactHeader;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $hero = ContactHero::where('is_active', true)->latest()->first();

        $header = ContactHeader::where('is_active', true)->latest()->first();

        return view('frontend.pages.contact', compact('hero', 'header'));
    }
}
