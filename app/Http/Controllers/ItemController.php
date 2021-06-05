<?php

namespace App\Http\Controllers;
use App\Http\Business\ItemBL;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Http\Model\Item;
use Illuminate\Http\Request;

class ItemController extends Controller{

    public function getItems()
    {
    	$ItemBL = new ItemBL();
    	$items = $ItemBL -> all();
    	return $items;
    }

    public function getIfItemIsUsed($itemId)
    {
        try {
            $ItemBL = new ItemBL();
            $isUsed = $ItemBL -> getIfItemIsUsed($itemId);
            return $isUsed;
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
    }
} 