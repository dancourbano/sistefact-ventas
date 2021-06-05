<?php

namespace App\Http\Controllers;

use App\Http\Business\ReportBL;
use Illuminate\Http\Request;
use Mockery\CountValidator\Exception;

class ReportProfitController extends Controller
{
    public function index(){
        return view('report.profit.index');
    }

    public function filterProfit(Request $request){
        try{
            $valuesFilter=array();
            $valuesFilter=($request->all());
            $reportBL=new ReportBL();
            $profit=$reportBL->getFilterProfit($valuesFilter);
            return response()->json($profit);
        }catch(Exception $e){

        }

    }
}
