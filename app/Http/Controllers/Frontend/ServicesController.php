<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ServicesHero;
use App\Models\ServiceHeader;
use App\Models\ServiceList;
use App\Models\ServicePick;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $hero = ServicesHero::where('is_active', true)->latest()->first();

        $header = ServiceHeader::where('is_active', true)->latest()->first();

        $services = ServiceList::where('is_active', true)->orderBy('id')->get();

        $servicePicks = ServicePick::orderBy('order')->get();

        return view('frontend.pages.services', compact('hero', 'header', 'services', 'servicePicks'));
    }
}
