<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:08
 */
namespace App\Http\Business;
use App\Http\Entities\DetailInvoiceBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use App\Http\Model\Driver;
use App\Http\Model\Invoice;
use Illuminate\Support\Facades\DB;
use Mockery\CountValidator\Exception;

class ReportBL {
    /*
    public function all()
    {
        $invoiceBE = Invoice::getInvoice();
        return  $invoiceBE;
    }

*/

    public function getFilterProfit($valuesFilter){

        try{
            $data=array();
            $data=Invoice::filterProfit($valuesFilter);
            return $data;
        }catch (Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }
    public function getFilterInvoicing($valuesFilter){

        try{
            $data=array();
            $data=Invoice::filterInvoicing($valuesFilter);
            return $data;
        }catch (Exception $e){
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
    }

}