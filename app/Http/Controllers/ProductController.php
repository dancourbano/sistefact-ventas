<?php

namespace App\Http\Controllers;
use App\Http\Business\ItemBL;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Entities\ItemBusinessEntity;
use App\Http\Business\PackageBL;
use App\Http\Entities\ApplicationMessage;
use App\Http\Entities\CustomizerViewBusinessEntity;

use Redirect;
use Schema;
use App\Http\Model\Item;
use Illuminate\Http\Request;

class ProductController extends Controller{

    public function index(Request $request)
    {
        $type=1; // services:0; products: 1
        $itemBL = new ItemBL();
        $products = $itemBL -> getItems($type);
        return view('item.products.index', compact('products'));
    }
    public function showHistory(Request $request)    {

        $itemBL = new ItemBL();
        $products = $itemBL -> showHistory();
        return view('item.products.history', compact('products'));
    }

    public function action($action,$productId){
        $data=new CustomizerViewBusinessEntity();
        $product=array();
        $data->setDisabled('');
        $data->setViewAction($action);
        if( $action =="edit"){
            $data->setDisabled('disabled');
            $data->setMode('edit');
            $product = Item::getItem($productId);
        }
        if($action=="create"){
            $data->setMode('create');
            $product = array(
                'itemId' => '0',
                'descripcion' => '',
                'basePrice' => '',
                'status'=> '',
                'itemNumber'=> '',
                'itemNumCurrent'=> ''
            );
        }

        return view('item.products.product')
            -> with(compact('action','product'));

    }

    public function delete($productId)
    {
        try{
            DB::beginTransaction();
            Item::deleteItem($productId);
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
        }
        
        return redirect()->action('ProductController@index');
    }

    public function sendDataProduct($action, $productId ,Request $request)
    {
        try {
            $type=1;//productos:1, servicios:0
            $productBEntity = new ItemBusinessEntity();
            $productBEntity -> setAllFromDataRowHTTPBase($request->all());
            $productBEntity -> setType($type);


            $productBL = new ItemBL();
            if ($action == "create") {
                $productBL -> createItem($productBEntity,0);
                ApplicationMessage::setMessageDetail('Producto creado correctamente.');
            }

            if ($action == "edit"){
                $productBL -> updateItem($productBEntity,$productId);
                ApplicationMessage::setMessageDetail('Producto editado correctamente.');
            }


        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
        }
        return response()->json(ApplicationMessage::toArray());

    }
} 