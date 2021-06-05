<?php

namespace App\Http\Business;
use \App\Http\Model\Movement;
use \App\Http\Entities;
use DB;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Support\Facades\Auth;


class MovementBL {
    public function all()
    {
        $movementBE = Movement::all();
        return  $movementBE;
    }

    public function getMovement($movementId)
    {
        $movement = Movement::getMovement($movementId);
        return (array)$movement;
    }

    public function createMovement($movementBEntity)
    {
        $movementBEntity -> getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        $movementBEntity -> getAuditoryInformation()
            ->setCreatedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                             // Init transaction
            Movement::createMovement($movementBEntity);         // Create movement
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Creación correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function updateMovement($movementBEntity)
    {
        $movementBEntity->getAuditoryInformation()
            ->setModifiedDate(date("Y-m-d H:i:s"));
        $movementBEntity->getAuditoryInformation()
            ->setModifiedBy(Auth::user()->id);
        try {
    DB::beginTransaction();                                     // Init transaction
            Movement::updateMovement($movementBEntity);         // Update movement
    DB::commit();                                               // Confirm operation

            ApplicationMessage::setMessageDetail('Actualización correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function deleteMovement($movementBEntity)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            Movement::deleteMovement($movementBEntity);         // Delete movement
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Eliminación correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function filterMovements($parameters)
    {
        $startDate = $parameters['startDate'];
        $endDate = $parameters['endDate'];
        $type = $parameters['type'];
        $groupBy = $parameters['groupBy'];

        $movementsFiltered = Movement::filterMovement($startDate,$endDate,$type,$groupBy);
        return $movementsFiltered;
    }

    public function filterMovementByDate($parameters)
    {
        $startDate = $parameters['startDate'];
        $endDate = $parameters['endDate'];

        $movementsFiltered = Movement::filterMovementByDate($startDate,$endDate);
        return $movementsFiltered;
    }

    public function getReportOfThisMonth()
    {
        return Movement::getReportOfThisMonth();
    }

    public function getTotalRevenue(){
        return Movement::getTotalRevenue();
    }
    public function getTotalExpenses(){
        return Movement::getTotalExpenses();
    }
}