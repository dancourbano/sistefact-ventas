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


class Package extends Model {

    protected $primaryKey = 'packageId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $table    = 'package';

    public static function getPackages(){

            $packages = DB::select("select
                package.packageId,
                package.name,
                package.basePrice,
                package.createdDate,
                sum(item.type = 1) as productos,
                sum(item.type = 0) as servicios
            from detailpackage
            inner join item on item.itemId = detailpackage.itemId
            inner join package on package.packageId = detailpackage.packageId
            group by
                  packageId,
                  package.name,
                  package.basePrice,
                  package.createdDate
            ");

        return $packages;
    }

     public static function getPackage($packageId){
        $package = Package::where('packageId','=',$packageId)
            -> select(
                    'packageId',
                    'name',
                    'basePrice'
                )
            -> first();

        return $package->toArray();
    }

    public static function createPackage($packageBEntity){
        $packageId = DB::table('package')->insertGetId(
            array(
                'name' => $packageBEntity->getName(),
                'basePrice' => $packageBEntity->getBasePrice(),
                'createdDate'=> $packageBEntity->getAuditoryInformation()->getCreatedDate(),
                'modifiedDate'=> $packageBEntity->getAuditoryInformation()->getCreatedDate(),
                'createdBy'=> $packageBEntity->getAuditoryInformation()->getCreatedBy()
            )
        );
        return $packageId;
    }

    public static function updatePackage($packageBEntity){
        DB::table('package')
            ->where('packageId',$packageBEntity -> getPackageId())
            ->update(
                array(
                    'name' => $packageBEntity->getName(),
                    'basePrice' => $packageBEntity->getBasePrice(),
                    'modifiedDate'=> $packageBEntity->getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy'=> $packageBEntity->getAuditoryInformation()->getModifiedBy()
                )
            );
    }

    public static function deletePackage($packageId){
        DB::table('package')
            ->where('packageId', $packageId)
            ->delete();
    }

    public static function getIfPackageIsUsedByInvoice($packageId){

        $query = DB::table('detailinvoice')
            -> select(
                    DB::raw("COUNT(*) AS uses")
                )
            -> where('detailinvoice.packageId',$packageId)
            -> first();

        if($query -> uses == 0) {
            return "false";
        } else {
            return "true";
        }
    
    }

}