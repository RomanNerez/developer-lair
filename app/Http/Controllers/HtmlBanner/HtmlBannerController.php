<?php

namespace App\Http\Controllers\HtmlBanner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HtmlBannerController extends Controller
{
    public function index()
    {
        return view('components.html_banner.index');
    }
}
