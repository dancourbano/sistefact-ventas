<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:06
 */


namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;



class Customer extends Model {

    protected $primaryKey = 'customerId';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */


    protected $table    = 'customer';

    public static function createCustomer($customerBEntity){
        $id=DB::table('customer')->insertGetId(
            array(
                'name' => $customerBEntity->getName(),
                'identification' => $customerBEntity->getIdentification(),
                'email'=>$customerBEntity->getEmail(),
                'lastName'=>$customerBEntity->getLastName(),
                'maritalStatus'=>$customerBEntity->getMaritalStatus(),
                'phone1'=>$customerBEntity->getPhone1(),
                'phone2'=>$customerBEntity->getPhone2(),
                'type'=>$customerBEntity->getType(),
                'birthday'=>$customerBEntity->getBirthday(),
                'city'=>$customerBEntity->getCity(),
                'address'=>$customerBEntity->getAddress(),

                'createdDate'=>$customerBEntity->getAuditoryInformation()->getCreatedDate(),
                'createdBy'=>$customerBEntity->getAuditoryInformation()->getCreatedBy()

            )
        );
        return $id;
    }
    public static function getAllCustomers(){
        $sql = DB::table('customer')
            -> select(
                'customer.*',
                DB::raw('count(vehicle.vehicleId) as vehiculos')
                )
            -> leftJoin('vehicle','customer.customerId','=','vehicle.customerId')
            ->groupBy('customer.customerId')
            -> get();
        return $sql;
    }
    public static function getVehicles($customerId){
        $customer=Customer::find($customerId);

        $vehicles = DB::table('vehicle')
            -> select(
                'vehicle.*'
            )
            ->where('vehicle.customerId','=',$customerId)
            -> get();

        $data=array(
            'customer'=>$customer,
            'vehicles'=>$vehicles
        );
        return $data;
    }
    public static function updateCustomer($customerBEntity){
        $result =  DB::table('customer')
            ->where('customerId',$customerBEntity->getCustomerId())
            ->update(
                array(
                    'name' => $customerBEntity->getName(),
                    'identification' => $customerBEntity->getIdentification(),
                    'email'=>$customerBEntity->getEmail(),
                    'lastName'=>$customerBEntity->getLastName(),
                    'maritalStatus'=>$customerBEntity->getMaritalStatus(),
                    'phone1'=>$customerBEntity->getPhone1(),
                    'phone2'=>$customerBEntity->getPhone2(),
                    'type'=>$customerBEntity->getType(),
                    'birthday'=>$customerBEntity->getBirthday(),
                    'city'=>$customerBEntity->getCity(),
                    'address'=>$customerBEntity->getAddress(),
                    'modifiedDate'=>$customerBEntity->getAuditoryInformation()->getModifiedDate(),
                    'modifiedBy'=>$customerBEntity->getAuditoryInformation()->getModifiedBy()
                )
            );

    }
    public static function deleteCustomer($idCustomer){
        DB::table('customer')
            ->where('customerId', $idCustomer)
            ->delete();
    }
    public static function getTotalCustomer(){
        $result=DB::table('customer')
            ->count();
        return $result;
    }



}