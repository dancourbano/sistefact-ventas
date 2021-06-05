<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:08
 */
namespace App\Http\Business;
use \App\Http\Model\Item;
use \App\Http\Entities;
use DB;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Support\Facades\Auth;


class ItemBL {
    public function all()
    {
        $type=false;
        $itemBE = Item::allHistory($type);
        return  $itemBE;
    }
    public function showHistory()
    {
        $type=true;
        $itemBE = Item::allHistory($type);
        return  $itemBE;
    }
    public function getItems($type)
    {
        $items = Item::getItems($type);
        return $items;
    }

    public function getItem($itemId)
    {
        $item = Item::getItem($itemId);
        return (array)$item;
    }

    public function createItem($itemBEntity)
    {
            $itemBEntity -> getAuditoryInformation()
                ->setCreatedDate(date("Y-m-d H:i:s"));
        $itemBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);

            try {
                DB::beginTransaction();                             // Init transaction
            Item::createItem($itemBEntity);                     // Create item
                DB::commit();                                       // Confirm operation
 
            ApplicationMessage::setMessageDetail('Creación correcta.');

            } catch (Exception $e) {
                ApplicationMessage::setErrorMessageDetail($e->getMessage());
                DB::rollback();                                     // Undo transaction
            }
        }

    public function updateItem($itemBEntity,$itemId)
    {
        $itemBEntity->getAuditoryInformation()
                ->setModifiedDate(date("Y-m-d H:i:s"));
        $itemBEntity->getAuditoryInformation()->setModifiedBy(Auth::user()->id);

        try {
            DB::beginTransaction();                             // Init transaction
            Item::updateItem($itemBEntity,$itemId);
            $itemBEntity->setHistoryId($itemId);// Update item
            $itemBEntity -> getAuditoryInformation()
                ->setCreatedDate(date("Y-m-d H:i:s"));
            $itemBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);
            Item::createItem($itemBEntity);
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Actualización correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function deleteItem($itemBEntity)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            Item::deleteItem($itemBEntity);                     // Update item
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Eliminación correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function getIfItemIsUsed($packageId)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            $isUsed = Item::getIfItemIsUsedByInvoiceOrPackage($packageId);
            DB::commit();                                       // Confirm operation

            return $isUsed;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }
}