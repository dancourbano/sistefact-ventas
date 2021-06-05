<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Business\MovementBL;

class ReportMovementsController extends Controller
{
    public function index() {

    	$MovementBL = new MovementBL();
    	$reportOfThisMonth = $MovementBL -> getReportOfThisMonth();

        $reportOfThisMonthComplete = array (
            ['type' => 1, 'quantity' => 0],
            ['type' => 2, 'quantity' => 0],
            ['type' => 3, 'quantity' => 0],
        );

        for( $j = 0 ; $j < sizeof($reportOfThisMonth) ; $j++ ) {
            for ($i = 0 ; $i < sizeof($reportOfThisMonthComplete) ; $i++) {
                if($reportOfThisMonthComplete[$i]['type'] == $reportOfThisMonth[$j]['type']){
                    $reportOfThisMonthComplete[$i]['quantity'] = $reportOfThisMonth[$j]['quantity'];
                }
            }
        }

        return view('report.movements.index')
            -> with(compact('reportOfThisMonthComplete'));



    }

}
