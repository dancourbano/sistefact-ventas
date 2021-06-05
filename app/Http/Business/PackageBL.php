<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 10:08
 */
namespace App\Http\Business;
use \App\Http\Model\Package;
use \App\Http\Model\DetailPackage;
use Illuminate\Support\Facades\Auth;
use \App\Http\Entities;
use DB;
use App\Http\Entities\ApplicationMessage;

class packageBL {

    public function getPackages()
    {
        $packages = Package::getPackages();
        return $packages;
    }

    public function getPackage($packageId)
    {
        $package = Package::getPackage($packageId);
        return (array)$package;
    }

    public function getAllDetailPackages(){
        $detailPackage = DetailPackage::all();
        return $detailPackage;
    }
    public function createPackage($packageBEntity)
    {
        $packageBEntity -> getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        $packageBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                             // Init transaction
            $packageId = Package::createPackage($packageBEntity);            // Create package
            DB::commit();                                       // Confirm operation

            return $packageId;
        ApplicationMessage::setMessageDetail('Creación correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function updatePackage($packageBEntity)
    {
        $packageBEntity->getAuditoryInformation()
                ->setModifiedDate(date("Y-m-d H:i:s"));
        $packageBEntity->getAuditoryInformation()->setModifiedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                             // Init transaction
            Package::updatePackage($packageBEntity);            // Update package
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Actualizacion correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function deletePackage($packageId)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            DetailPackage::deleteDetailPackageFromPackage($packageId);  // Delete all its detailPackage
            Package::deletePackage($packageId);                 // Delete package
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Eliminacion correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function createDetailPackage($DetailPackageBEntity)
    {
        $DetailPackageBEntity -> getAuditoryInformation()
            ->setCreatedDate(date("Y-m-d H:i:s"));
        $DetailPackageBEntity->getAuditoryInformation()->setCreatedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                             // Init transaction
            DetailPackage::createDetailPackage($DetailPackageBEntity);            // Create package
            DB::commit();                                       // Confirm operation

        ApplicationMessage::setMessageDetail('Creacion de detalle correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
        return response()->json(ApplicationMessage::toArray());
    }

    public function updateDetailPackage($DetailPackageBEntity)
    {
        $DetailPackageBEntity->getAuditoryInformation()
                ->setModifiedDate(date("Y-m-d H:i:s"));
        $DetailPackageBEntity->getAuditoryInformation()->setModifiedBy(Auth::user()->id);
        try {
            DB::beginTransaction();                             // Init transaction
            DetailPackage::updateDetailPackage($DetailPackageBEntity);            // Update package
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Actualizacion correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
        return response()->json(ApplicationMessage::toArray());
    }

    public function deleteDetailPackage($detailPackageId)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            DetailPackage::deleteDetailPackage($detailPackageId);                 // Delete package
            DB::commit();                                       // Confirm operation

            ApplicationMessage::setMessageDetail('Eliminacion correcta.');

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }

    public function getDetailPackage($packageId)
    {
        $detailPackage = DetailPackage::getDetailPackagesFromPackage($packageId);
        return $detailPackage;
    }

    public function getDetailPackageAndType($packageId)
    {
        $detailPackage = DetailPackage::getDetailPackagesAndTypeFromPackage($packageId);
        return $detailPackage;
    }

    public function getIfPackageIsUsed($packageId)
    {
        try {
            DB::beginTransaction();                             // Init transaction
            $isUsed = Package::getIfPackageIsUsedByInvoice($packageId);                
            DB::commit();                                       // Confirm operation

            return $isUsed;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e->getMessage());
            DB::rollback();                                     // Undo transaction
        }
    }
}