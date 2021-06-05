<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:08
 */
namespace App\Http\Business;
use \App\Http\Model\Customer;
use \App\Http\Entities\CustomerBE;
use App\Http\Entities\ApplicationMessage;
use App\Http\Model\Vehicle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use \App\User;

class CustomerBL {
    public function all()
    {
        $customerBE = Customer::getAllCustomers();
        return  $customerBE;
    }
    public function getCustomer($customerId)
    {
        $customerBE = Customer::find($customerId);
        return  $customerBE;
    }
    public function showVehicles($customerId){
        $vehicles=Customer::getVehicles($customerId);
        return $vehicles;
    }
    public function updateCustomer($customerBEntity)
    {
        try {
            //Iniciar Transacción


            //Log::info(Input::get('name'));
            //Log::info(Input::get('customerId'));
            $customerBEntity->getAuditoryInformation()
                ->setModifiedDate(date("Y-m-d H:i:s"));

            $customerBEntity->getAuditoryInformation()->setModifiedBy(Auth::user()->id);

            Customer::updateCustomer($customerBEntity);

            ApplicationMessage::setMessageDetail('Cliente actualizado correctamente.');
            CRUDManager::changeManagerCustomer($customerBEntity,'editar',$customerBEntity->getCustomerId(),Auth::user()->name);
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
    public function createCustomer($customerBEntity)
    {
        //Crear Cliente
        $id=0;
        $customerBEntity->getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));

        $customerBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);
        try {
            //Iniciar Transacción
            DB::beginTransaction();
            //Instanciar Entity indicando el tipo Customer

            $customerBEntity->getAuditoryInformation()
                ->setCreatedBy(\Auth::user()->userId);
            //Crear Customer
            $id = Customer::createCustomer($customerBEntity);
            //Confirmar Operación
            DB::commit();
            ApplicationMessage::setMessageDetail('Cliente creado correctamente.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
            DB::rollback();
        }
        CRUDManager::changeManagerCustomer($customerBEntity,'crear',$id,Auth::user()->name);
        return $id;
    }
    public function deleteCustomer($customerId)
    {
        //Crear Cliente


        try {
            Customer::deleteCustomer($customerId);
            ApplicationMessage::setMessageDetail('Cliente creado correctamente.');
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail("Error al Eliminar Cliente");
            //Deshacer Transacción

        }
        return ApplicationMessage::toArray();
    }
    public function getTotalCustomer(){

        $result =Customer::getTotalCustomer();
        return $result;
    }
}