<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:06
 */


namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon;



class Item extends Model {

    protected $primaryKey = 'itemId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $table    = 'item';

    public static function getItems($type){
        $items = Item::where('type','=',$type)
            ->where('historyId','=',Null)
            -> select('*')
            -> get();

        return $items;
    }

    public static function allHistory($type){
        if($type==true) $operator='!=';
        else $operator='=';
        $items = Item::where('historyId',$operator,Null)
            -> select('*')
            -> get();
        return $items;
    }
    public static function getItem($itemId){
        $item = Item::where('itemId','=',$itemId)
            -> select(
                    'itemId',
                    'descripcion',
                    'basePrice',
                    'type',
                    'itemNumber',
                    'status',
                    'itemNumCurrent'
                )
            -> first();

        return $item->toArray();
    }

    public static function createItem($itemBEntity){
        DB::table('item')->insert(
            array(
                'descripcion' => $itemBEntity->getDescripcion(),
                'basePrice' => $itemBEntity->getBasePrice(),
                'type'=> $itemBEntity->getType(),
                'itemNumber'=>$itemBEntity->getItemNumber(),
                'status'=>$itemBEntity->getStatus(),
                'historyId'=>$itemBEntity->getHistoryId(),
                'itemNumCurrent'=>$itemBEntity->getItemNumCurrent(),
                'createdDate'=>$itemBEntity->getAuditoryInformation()->getCreatedDate(),
                'createdBy'=>$itemBEntity->getAuditoryInformation()->getCreatedBy()
            )
        );
    }

    public static function updateItem($itemBEntity,$itemId){
        DB::table('item')
            ->where('itemId',$itemId)
            ->update(
                array(
                    'descripcion' => $itemBEntity->getDescripcion(),
                    'basePrice' => $itemBEntity->getBasePrice(),
                    'itemNumber'=>$itemBEntity->getItemNumber(),
                    'status'=>$itemBEntity->getStatus(),
                    'historyId'=>$itemBEntity->getHistoryId(),
                    'itemNumCurrent'=>$itemBEntity->getItemNumCurrent(),
                    'modifiedDate'=>$itemBEntity->getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy'=>$itemBEntity->getAuditoryInformation()->getModifiedBy()
                )
            );
    }

    public static function deleteItem($itemId){
        DB::table('item')
            ->where('itemId', $itemId)
            ->delete();
    }

    public static function getIfItemIsUsedByInvoiceOrPackage($itemId){

        $queryInvoice = DB::table('detailinvoice')
            -> select(
                DB::raw("COUNT(*) AS uses")
            )
            -> where('detailinvoice.itemId',$itemId)
            -> first();

        $queryPackage = DB::table('detailpackage')
            -> select(
                DB::raw("COUNT(*) AS uses")
            )
            -> where('detailpackage.itemId',$itemId)
            -> first();

        $uses = $queryInvoice -> uses + $queryPackage -> uses;

        if($uses == 0) {
            return "false";
        } else {
            return "true";
        }

    }

    public static function decrementProductStock($productId,$quantity){
        DB::table('item')
            -> where('item.itemId',$productId)
            -> decrement('item.itemNumCurrent', $quantity);
    }

}