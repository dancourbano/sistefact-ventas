<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:03
 */

namespace App\Http\Controllers;



use App\Http\Entities\DetailInvoiceBusinessEntity;
use App\Mail\Invoice;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Business\CustomerBL;
use App\Http\Business\DriverBL;
use App\Http\Business\InvoiceBL;
use App\Http\Business\ItemBL;
use App\Http\Business\packageBL;
use App\Http\Business\VehicleBL;
use App\Http\Entities\DriverBusinessEntity;
use App\Http\Entities\InvoiceBusinessEntity;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Redirect;
use Schema;;
use App\Http\Entities\ApplicationMessage;
use App\Http\Entities\CustomizerViewBusinessEntity;
use Illuminate\Support\Facades\DB;


class InvoiceController extends Controller {


    public function index(Request $request)
    {
        $invoiceBL= new InvoiceBL();
        $invoiceBE= $invoiceBL->allInvoicesAndPlaca();
        response();

        return view('invoice.index')->with(compact('invoiceBE'));

    }

    public function getInvoice($invoiceId){
        $invoiceBL=new InvoiceBL();
        $invoice=$invoiceBL->getInvoiceAndDetail($invoiceId);
        $vehicleBL=new VehicleBL();
        $vehicle=array();

        foreach ($invoice['invoiceDetail'] as $detailInvoice){
            if ($detailInvoice -> vehicleId=='0'){
                $detailInvoice -> vehicleId = "Ninguno";
            }else{
                $vehicle=$vehicleBL->getVehicle($detailInvoice -> vehicleId);
                $detailInvoice -> vehicleId=$vehicle['placa'];
            }
        }
        return response()->json($invoice);

    }
    public function showInvoice($action, $invoiceId){

        $data=new CustomizerViewBusinessEntity();
        $invoice=array();
        $data->setDisabled('');
        $data->setViewAction($action);
        $itemBL=new ItemBL();
        $packageBL=new packageBL();
        $productList = $itemBL->getItems(1);
        $serviceList = $itemBL->getItems(0);
        $packageList = $packageBL->getPackages();
        if( $action == "show"){

        }else{
            if( $action =="edit"){
                /*
                $data->setDisabled('disabled');
                $data->setMode('edit');
                $invoiceBL=new InvoiceBL();
                $invoice = $invoiceBL->get($driverId);
                */
            }
            if($action=="create"){
                $data->setMode('create');
                $invoice = array(
                    'invoiceId' => '0',
                    'taxType' => '',
                    'tax'=> '',
                    'disccountValue'=> '',
                    'subtotal'=>'',
                    'datePayMax'=>'',
                    'status'=>'',
                    'disccountType'=>'',
                    'total'=>'',
                    'is_sendEmail'=>'',
                    'repeatinvoice'=>'',
                    'notes'=>'',
                    'debt'=>'',
                    'customerId'=>'',
                    'paymentLateType'=>'',
                    'methodpayment'=> ''
                );
            }
        }

        return view('invoice.invoice')->with(
            array(
                'invoice'=>$invoice,
                'data'=>$data->toArrayBase(),
                'productList'=>$productList,
                'serviceList'=>$serviceList,
                'packageList'=>$packageList

            ));
    }

    public function filterInvoice(Request $request){
        try{
            $valuesFilter=array();
            $valuesFilter=($request->all());
            $invoiceBL=new InvoiceBL();
            $invoice=$invoiceBL->getFilterInvoice($valuesFilter);
            //console.log($valuesFilter);
            return response()->json($invoice);

        }catch(Exception $e){

        }
    }

    public function sendDataInvoice($action,Request $request)
    {
        //echo $action;
        //die();
        $invoiceId='';
        try {
            //trayendo mi lista de productos para el paquete
            $invoiceBEntity = new InvoiceBusinessEntity();
            $invoiceBEntity->setInvoiceId($_POST['invoiceId']);
            $invoiceBEntity->setTaxType($_POST['taxType']);
            $invoiceBEntity->setTax($_POST['tax']);
            $invoiceBEntity->setDisccountValue($_POST['disccountValue']);
            $invoiceBEntity->setSubtotal($_POST['subtotal']);
            $invoiceBEntity->setDatePayMax($_POST['datePayMax']);
            $invoiceBEntity->setStatus($_POST['status']);
            $invoiceBEntity->setDisccountType($_POST['disccountType']);
            $invoiceBEntity->setTotal($_POST['total']);
            $invoiceBEntity->setIsSendEmail($_POST['is_sendEmail']);
            $invoiceBEntity->setRepeatInvoice($_POST['repeatInvoice']);
            $invoiceBEntity->setDebt($_POST['debt']);
            $invoiceBEntity->setCustomerId($_POST['customerId']);
            $invoiceBEntity->setMethodPayment($_POST['methodpayment']);
            $listaProductos = json_decode($_POST['productos'],true);


            //primero modificamos en la tabla product


            // traemos los datos del formulario



            //var_dump($invoice);
            //die();

            // Guardamos los datos en la entidad producto


            $invoiceBL=new InvoiceBL();
            $invoiceId=$invoiceBL->createInvoice($invoiceBEntity,$listaProductos);


        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
        return response()->json($invoiceId);

    }

    public function printInvoice($invoiceId){
        $invoiceBL=new InvoiceBL();
        $invoice=$invoiceBL->getInvoiceAndDetail($invoiceId);
        $vehicleBL=new VehicleBL();
        $vehicle=array();

        foreach ($invoice['invoiceDetail'] as $detailInvoice){
            if ($detailInvoice -> vehicleId=='0'){
                $detailInvoice -> vehicleId = "Ninguno";
            }else{
                $vehicle=$vehicleBL->getVehicle($detailInvoice -> vehicleId);
                $detailInvoice -> vehicleId=$vehicle['placa'];
            }
        }

        return view('invoice.invoicePrint')->with(compact('invoice'));
    }
    public function pdfInvoice($invoiceId){
        $invoiceBL=new InvoiceBL();
        $invoice=$invoiceBL->getInvoiceAndDetail($invoiceId);
        $vehicleBL=new VehicleBL();
        $vehicle=array();

        foreach ($invoice['invoiceDetail'] as $detailInvoice){
            if ($detailInvoice -> vehicleId=='0'){
                $detailInvoice -> vehicleId = "Ninguno";
            }else{
                $vehicle=$vehicleBL->getVehicle($detailInvoice -> vehicleId);
                $detailInvoice -> vehicleId=$vehicle['placa'];
            }
        }
        $pdf=new Dompdf();
        $pdf->set_option('defaultFont', 'Courier');
        $pdf->loadHtml(view('invoice.invoicePDF')->with(compact('invoice')));
        $pdf->setPaper('A4', 'landscape');
        $pdf->render();

        return $pdf->stream();
    }

    public function excelInvoice($invoiceId){
        $invoiceBL=new InvoiceBL();
        $invoice=$invoiceBL->getInvoiceAndDetail($invoiceId);
        $vehicleBL=new VehicleBL();
        $vehicle=array();

        foreach ($invoice['invoiceDetail'] as $detailInvoice){
            if ($detailInvoice -> vehicleId=='0'){
                $detailInvoice -> vehicleId = "Ninguno";
            }else{
                $vehicle=$vehicleBL->getVehicle($detailInvoice -> vehicleId);
                $detailInvoice -> vehicleId=$vehicle['placa'];
            }
        }

        Excel::create('Factura excel', function($excel) use ($invoice) {

            $excel->sheet('New sheet', function($sheet) use ($invoice) {

                $sheet->loadView('invoice.invoicePDF')->with('invoice',$invoice);

            })->export('xls');

        });
    }

    public function emailInvoice($invoiceId,$customerId){
        $invoiceBL=new InvoiceBL();
        $invoice=$invoiceBL->getInvoiceAndDetail($invoiceId);
        $customerBL=new CustomerBL();
        $customer=$customerBL->getCustomer($customerId);

        $nombre=$customer['name']." ".$customer['lastName'];
        $email=$customer['email'];
        Mail::to($email,$nombre)
            ->send(new Invoice($invoice));
        return view('invoice.emailSend')->with(compact('customer'));
    }

    public function getInvoiceForDashboard($year,$month){
        $invoiceBL=new InvoiceBL();
        return $invoiceBL->getInvoiceForDashboard($month, $year);
    }


    public function deleteInvoice($invoiceId){
        try{
            $invoiceBL=new InvoiceBL();
            $invoiceBL->deleteInvoice($invoiceId);

        }catch (Exception $e){

        }
        return redirect()->action('InvoiceController@index');
    }

    public function generateInvoice(){
        $invoices = \App\Http\Model\Invoice::where('repeatInvoice',2)->get();

        foreach ($invoices as $invoice) {
            $datetimeDB = new \DateTime($invoice["createdDate"]);
            $daysDB = $datetimeDB->format('d');
            $datetime = new \DateTime();
            $days = $datetime->format('d');
            $invoiceBL=new InvoiceBL();
            $detailInvoices=$invoiceBL->getDetailInvoice($invoice['invoiceId']);

            if ($daysDB == $days) {

                $id = DB::table('invoice')->insertGetId(
                    array(
                        'taxType' => $invoice["taxType"],
                        'tax' => $invoice["tax"],
                        'disccountValue' => $invoice["disccountValue"],
                        'subtotal' => $invoice["subtotal"],
                        'datePayMax' => $invoice["datePayMax"],
                        'status' => "0",
                        'disccountType' => $invoice["disccountType"],
                        'total' => $invoice["total"],
                        'is_sendEmail' => $invoice["is_sendEmail"],
                        'repeatInvoice' => $invoice["repeatInvoice"],
                        'notes' => $invoice["notes"],
                        'debt' => $invoice["total"],
                        'customerId' => $invoice["customerId"],
                        'delayedPaymentDetailInvoiceId' => $invoice["delayedPaymentDetailInvoiceId"],
                        'methodpayment' => $invoice["methodpayment"],
                        'createdDate' => $datetime->format('Y-m-d H:i:s'),
                        'createdBy' => "0"
                    )
                );
                foreach($detailInvoices as $detailInvoice){
                    $idDetail = DB::table('detailinvoice') -> insertGetId(
                        array(
                            'price' => $detailInvoice->price,
                            'status' => $detailInvoice->status,
                            'quantity' => $detailInvoice->quantity,
                            'description' => $detailInvoice->description,
                            'invoiceId' => $id,
                            'packageId' => $detailInvoice->packageId,
                            'itemId' => $detailInvoice->itemId,
                            'vehicleId' => $detailInvoice->vehicleId
                        )
                    );
                }
                if($invoice['is_sendEmail']==1){
                    $invoiceBL=new InvoiceBL();
                    $invoiceNew=$invoiceBL->getInvoiceAndDetail($id);
                    $customerBL=new CustomerBL();
                    $customer=$customerBL->getCustomer($invoiceNew['invoice']->customerId);

                    $nombre=$customer['name']." ".$customer['lastName'];
                    $email=$customer['email'];

                    if($email!=null){
                        Mail::to($email,$nombre)
                            ->send(new Invoice($invoiceNew));
                    }

                }

            }

        }
        echo("comando ejecutado!");
    }

    public function viewEmail($invoiceId){
        $invoiceBL=new InvoiceBL();
        $invoice=$invoiceBL->getInvoiceAndDetail($invoiceId);
        return view('invoice.invoiceEmail')->with(compact('invoice'));
    }
}
