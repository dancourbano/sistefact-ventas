<?php
/**
 * Created by PhpStorm.
 * User: PERSONAL
 * Date: 10/10/16
 * Time: 12:55 PM
 */

namespace App\Http\Controllers;
use Redirect;
use Schema;;
use App\Http\Business\ItemBL;
use App\Http\Entities\ItemBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Http\Request;

class ServiceController extends Controller{
    public function index()
    {   $type=0; // services:0; products: 1
    	$itemBL = new ItemBL();
        $services = $itemBL -> getItems(0);
        return view('item.services.index')
                -> with(compact('services'));
    }

    public function create()
    {
        $dataService = array(
            'itemId' => 0,
            'descripcion' => '',
            'basePrice' => '',
            'type' => 0,
            'itemNumber' => '',
            'status' => '',
            'itemNumCurrent' => ''
        );

        $action = 'create';
        return view('item.services.service')
                -> with(compact('action','dataService'));
    }

    public function edit($serviceId)
    {   
        $itemBL = new ItemBL();
        $dataService = $itemBL -> getItem($serviceId);
        $action = 'edit';

        return view('item.services.service')
                -> with(compact('action','dataService'));
    }

    public function delete($serviceId)
    {
        $serviceBL = new ItemBL();
        $serviceBL -> deleteItem($serviceId);
        
        return redirect()->action('ServiceController@index');
    }

    public function SendDataService($action, Request $request)
    {
        try {
            $serviceBEntity = new ItemBusinessEntity();
            $serviceBEntity -> setAllFromDataRowHTTPBase($request->all());
            $serviceBEntity -> setType(0);

            $serviceBL = new ItemBL();
            if ($action == "create") {
                $serviceBL -> createItem($serviceBEntity);
                ApplicationMessage::setMessageDetail('Servicio creado correctamente.');
            }

            if ($action == "edit") {
                $serviceBL -> updateItem($serviceBEntity, $request['serviceId']);
                ApplicationMessage::setMessageDetail('Servicio editado correctamente.');
            }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        } 
        return response()->json(ApplicationMessage::toArray());

    }
} 