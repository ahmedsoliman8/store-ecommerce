<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\LaravelLocalization;

class DashboardController extends Controller
{
    public  function index(){
        return view('dashboard.index');

    }
}
