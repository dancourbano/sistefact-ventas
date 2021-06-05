<?php
/**
 * User: Oscar
 * Date: 19/10/2016
 * Time: 11:40
 */

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon;


class DetailPackage extends Model {

    protected $primaryKey = 'detailPackageId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $table    = 'detailpackage';

    public static function getDetailPackages(){
        $detailPackages = DetailPackage::select('*')
            -> get();

        return $detailPackages;
    }

    public static function getDetailPackagesFromPackage($packageId){
        $detailPackages = DetailPackage::where('packageId','=',$packageId)
            -> select(
                'detailPackageId',
                'basePrice',
                'quantity',
                'itemId',
                'packageId'
            )
            -> get();

        return $detailPackages;
    }
    public static function getDetailPackagesAndTypeFromPackage($packageId){

        $detailPackages = DetailPackage::where('packageId','=',$packageId)
            -> select(
                'detailpackage.detailPackageId',
                'detailpackage.basePrice',
                'detailpackage.quantity',
                'detailpackage.itemId',
                'detailpackage.packageId',
                'item.type as typeItem'
            )
            -> join('item','item.itemId','=','detailpackage.itemId')
            -> get();

        return $detailPackages;
    }

    public static function getDetailPackage($detailPackageId){
        $detailPackage = Package::where('detailPackageId','=',$detailPackageId)
            -> select(
                    'detailPackageId',
                    'basePrice',
                    'quantity',
                    'itemId',
                    'packageId'
                )
            -> first();

        return $detailPackage->toArray();
    }


    public static function createDetailPackage($detailPackageBEntity){
        DB::table('detailpackage')->insert(
            array(
                'basePrice' => $detailPackageBEntity->getBasePrice(),
                'quantity' => $detailPackageBEntity->getQuantity(),
                'itemId' => $detailPackageBEntity->getItemId(),
                'packageId' => $detailPackageBEntity->getPackageId(),
                'createdDate'=> $detailPackageBEntity->getAuditoryInformation()->getCreatedDate(),
                'modifiedDate'=> $detailPackageBEntity->getAuditoryInformation()->getCreatedDate(),
                'createdBy'=> $detailPackageBEntity->getAuditoryInformation()->getCreatedBy()
            )
        );
    }

    public static function updateDetailPackage($detailPackageBEntity){
        DB::table('detailpackage')
            ->where('detailPackageId',$detailPackageBEntity -> getDetailPackageId())
            ->update(
                array(
                    'basePrice' => $detailPackageBEntity->getBasePrice(),
                    'quantity' => $detailPackageBEntity->getQuantity(),
                    'itemId' => $detailPackageBEntity->getItemId(),
                    'packageId' => $detailPackageBEntity->getPackageId(),
                    'modifiedDate'=> $detailPackageBEntity->getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy'=> $detailPackageBEntity->getAuditoryInformation()->getModifiedBy()
                )
            );
    }

    public static function deleteDetailPackage($detailPackageId){
        DB::table('detailpackage')
            ->where('detailPackageId', $detailPackageId)
            ->delete();
    }

    public static function deleteDetailPackageFromPackage($packageId){
        DB::table('detailpackage')
            ->where('packageId', $packageId)
            ->delete();
    }

}