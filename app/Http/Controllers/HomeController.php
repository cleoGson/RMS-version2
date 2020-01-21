<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use  App\Charts\UserChart;
use App\User;
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
        $chart = new UserChart();
        $chart->labels(['One', 'Two', 'Three', 'Four','Five','six','seven']);
        $chart->dataset('My dataset', 'bar', [1, 2, 3, 4,9])->backgroundcolor('#4545df');
        $chart->dataset('My dataset 2', 'bar', [4, 3, 2, 1,9])->backgroundcolor('#3ae374');
        $chart->dataset('data set 3', 'bar',array(12,12,3,4,5,7,6))->backgroundcolor('#3097d1');
        return view('home',compact('chart'));
    }
}
