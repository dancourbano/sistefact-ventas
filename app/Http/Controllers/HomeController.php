<?php

namespace App\Http\Controllers;
use App\Http\Middleware;
use Illuminate\Http\Request;
use App\Http\Business\CustomerBL;
use App\Http\Business\MovementBL;
use App\Http\Business\UsersBL;
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
        $customerBL = new CustomerBL();
        $customerTotal = $customerBL -> getTotalCustomer();
        $movementBL=new MovementBL();
        $totalRevenue=$movementBL->getTotalRevenue();
        $totalExpenses=$movementBL->getTotalExpenses();
        $usersBL=new UsersBL();
        $usersTotal=$usersBL->getTotalUsers();
        return view('welcome',['customerTotal' => $customerTotal,'totalRevenue'=>$totalRevenue,'totalExpenses'=>$totalExpenses,'totalUsers'=>$usersTotal]);

    }
    public function monitor()
    {
        $customerBL = new CustomerBL();
        $customerTotal = $customerBL -> getTotalCustomer();
        $movementBL=new MovementBL();
        $totalRevenue=$movementBL->getTotalRevenue();
        $totalExpenses=$movementBL->getTotalExpenses();
        $usersBL=new UsersBL();
        $usersTotal=$usersBL->getTotalUsers();
        return view('welcome',['customerTotal' => $customerTotal,'totalRevenue'=>$totalRevenue,'totalExpenses'=>$totalExpenses,'totalUsers'=>$usersTotal]);


    }
}
