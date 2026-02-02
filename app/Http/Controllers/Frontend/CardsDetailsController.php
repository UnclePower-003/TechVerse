<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class CardsDetailsController extends Controller
{
    public function index(Project $project)
    {
        return view('frontend.pages.cardsdetails', compact('project'));
    }
}
