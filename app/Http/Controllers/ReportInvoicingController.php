<?php

namespace App\Http\Controllers;

use App\Http\Business\CustomerBL;
use App\Http\Business\ReportBL;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
class ReportInvoicingController extends Controller
{
    public function index(){
        $customerBl=new CustomerBL();
        $customerList=$customerBl->all();
        return view('report.invoicing.index')->with(compact('customerList'));
    }
    public function filterInvoicing(Request $request){
        try{
            $valuesFilter=array();
            $valuesFilter=($request->all());
            $reportBL=new ReportBL();
            $invoicing=$reportBL->getFilterInvoicing($valuesFilter);
            Session::put('report',$invoicing);
            return response()->json($invoicing);
        }catch(Exception $e){

        }

    }
    public function printInvoicing($startEmission,$endEmission,$customerId,$status){
        $detailInvoicing=array(
            'startEmission'=>$startEmission,
            'endEmission'=>$endEmission,
            'customerId'=>$customerId,
            'status'=>$status
        );
        $data=Session::get('report');
        foreach ($data['detailinvoice'] as $detalle){

            if ($detalle -> methodpayment=='0'){
                $detalle -> methodpayment = "Cuenta Bancaria";
            }
            if ($detalle -> methodpayment=='1'){
                $detalle -> methodpayment = "Al Contado";
            }

        }
        return view('report.invoicing.reportInvoicingPrint')->with(compact('data','detailInvoicing'));
    }

    public function pdfInvoicing($startEmission,$endEmission,$customerId,$status){
        $detailInvoicing=array(
            'startEmission'=>$startEmission,
            'endEmission'=>$endEmission,
            'customerId'=>$customerId,
            'status'=>$status
        );
        $data=Session::get('report');
        foreach ($data['detailinvoice'] as $detalle){

            if ($detalle -> methodpayment=='0'){
                $detalle -> methodpayment = "Cuenta Bancaria";
            }
            if ($detalle -> methodpayment=='1'){
                $detalle -> methodpayment = "Al Contado";
            }

        }

        $pdf=new Dompdf();
        $pdf->set_option('defaultFont', 'Courier');
        $pdf->loadHtml(view('report.invoicing.reportInvoicingPDF')->with(compact('data','detailInvoicing')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream();
    }
    public function excelInvoicing($startEmission,$endEmission,$customerId,$status){
        $detailInvoicing=array(
            'startEmission'=>$startEmission,
            'endEmission'=>$endEmission,
            'customerId'=>$customerId,
            'status'=>$status
        );
        $data=Session::get('report');
        foreach ($data['detailinvoice'] as $detalle){

            if ($detalle -> methodpayment=='0'){
                $detalle -> methodpayment = "Cuenta Bancaria";
            }
            if ($detalle -> methodpayment=='1'){
                $detalle -> methodpayment = "Al Contado";
            }

        }

        Excel::create('Factura excel', function($excel) use ($data,$detailInvoicing) {

            $excel->sheet('New sheet', function($sheet) use ($data,$detailInvoicing) {

                $sheet->loadView('report.invoicing.reportInvoicingPDF')->with(compact('data','detailInvoicing'));

            })->export('xls');

        });
    }
}
