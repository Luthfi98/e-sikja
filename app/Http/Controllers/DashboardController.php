<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    function index(){

        if (Auth::user()->role === 'admin') {
            return $this->admin();
        }else if (Auth::user()->role === 'operator') {
            return $this->operator();
        }else{
            return $this->resident();
        }
    }

    private function admin(){
        return view('cms.dashboard.admin');
    }

    private function operator(){
        return view('cms.dashboard.operator');
    }

    private function resident(){
        return view('cms.dashboard.resident');
    }
}
