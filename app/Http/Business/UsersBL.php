<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 16/11/2016
 * Time: 11:43
 */

namespace App\Http\Business;
use \App\Http\Model\User;
use \App\Http\Entities\UsersBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Support\Facades\DB;

class UsersBL {
    public function all()
    {
        $UsersBE = User::all();
        return  $UsersBE;
    }
    public function getUsers($UsersId)
    {
        $UsersBE = User::findOrFail($UsersId);
        return  $UsersBE;
    }
    public function updateUsers($UsersBEntity)
    {
        try {
            //Iniciar Transacción


            //Log::info(Input::get('UsersId'));
            $UsersBEntity->getAuditoryInformation()
                ->setModifiedDate(date("Y-m-d H:i:s"));

            User::updateUsers($UsersBEntity);

            ApplicationMessage::setMessageDetail('usuario actualizado correctamente.');
        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
    public function createUsers($UsersBEntity)
    {
        //Crear Cliente
        $id=0;
        $UsersBEntity->getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        try {
            //Iniciar Transacción
            DB::beginTransaction();
            //Instanciar Entity indicando el tipo Users


            //Crear Users
            $id = User::createUsers($UsersBEntity);
            //Confirmar Operación
            DB::commit();
            ApplicationMessage::setMessageDetail('Usuario creado correctamente.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción
            DB::rollback();
        }
        return $id;
    }
    public function deleteUsers($UsersId)
    {
        //Crear Cliente


        try {
            User::findOrFail($UsersId);
            User::destroy($UsersId);

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            //Deshacer Transacción

        }
    }
    public function getTotalUsers(){

        $result =User::getTotalUsers();
        return $result;
    }
}