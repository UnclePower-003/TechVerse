<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutFeature;
use App\Models\ContactInfo;
use App\Models\MapSetting;
use App\Models\TrustingPartner;
use App\Models\User;
use App\Models\Message;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            // Home Page
            // 'heroCount' => HeroSection::count(),
            // 'userCount' => User::count(),
            // 'aboutFeatureCount' => AboutFeature::count(),
            // Contact
            // 'contactSubmissionsCount' => Message::count(),
            // 'contactInfoCount' => ContactInfo::count(),
            // 'partnersCount' => TrustingPartner::count(),
            // 'mapLocationCount' => MapSetting::count(),
            // 'faqSecondCount' => FaqSecond::count(),
        ]);
    }
}
