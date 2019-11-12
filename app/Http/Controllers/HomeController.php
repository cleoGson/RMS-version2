<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $year=date('Y');
        // for($i=1;$i<=12;$i++){
        // $days=cal_days_in_month(CAL_GREGORIAN,$i,$year);
        // for($j=1;$j<=$days;$j++){         
        //       $calendardates[]=date("$j-$i-$year");
        // }
        // }
        // $age=substr((date('Ymd')-date('Ymd', strtotime(date('1994-07-21 00:00:00')))), 0, -4);
        return view('home');
    }
}
