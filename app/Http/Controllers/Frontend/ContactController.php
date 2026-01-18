<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactHero;
use App\Models\ContactHeader;
use App\Models\ContactInfo;
use App\Models\ContactSupportPromise;
use App\Models\ContactChoose;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $hero = ContactHero::where('is_active', true)->latest()->first();

        $header = ContactHeader::where('is_active', true)->latest()->first();

        $info = ContactInfo::where('is_active', true)->latest()->first();

        $promise = ContactSupportPromise::where('is_active', true)->latest()->first();

        $cards = ContactChoose::orderBy('order')->get();

        return view('frontend.pages.contact', compact('hero', 'header', 'info', 'promise', 'cards'));
    }
}
