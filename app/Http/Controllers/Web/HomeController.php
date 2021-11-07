<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PortfolioGroup;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index() {

        $groupPortfolios = PortfolioGroup::where('active', 1)->get();
        $portfolios = Portfolio::where('active', 1)->get();

        return view('web.pages.home', compact('groupPortfolios', 'portfolios'));
    }
}
