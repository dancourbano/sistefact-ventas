<?php
/**
 * User: Oscar
 * Date: 19/10/16
 * Time: 11:48 AM
 */

namespace App\Http\Controllers;
use Redirect;
use Schema;
use App\Http\Business\PackageBL;
use App\Http\Entities\PackageBusinessEntity;
use App\Http\Entities\DetailPackageBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Http\Request;

class PackageController extends Controller {
    public function index()
    {   
    	$packageBL = new PackageBL();
        $packages = $packageBL -> getPackages();
        return view('package.index')
                -> with(compact('packages'));
    }

    public function create()
    {
        $dataPackage = array(
            'packageId' => 0,
            'name' => '',
            'basePrice' => ''
        );

        $action = 'create';
        return view('package.package')
                -> with(compact('action','dataPackage'));
    }

    public function edit($packageId)
    {   
        $packageBL = new PackageBL();
        $dataPackage = $packageBL -> getPackage($packageId);
        $action = 'edit';

        return view('package.package')
                -> with(compact('action','dataPackage'));
    }

    public function delete($packageId)
    {
        $packageBL = new PackageBL();
        $packageBL -> deletePackage($packageId);

        return redirect()->action('PackageController@index');
    }

    public function sendDataPackage($action)
    {
        try {
                $packageBEntity = new PackageBusinessEntity();

                $packageBEntity -> setPackageId($_POST['packageId']);
                $packageBEntity -> setName($_POST['name']);
                $packageBEntity -> setBasePrice($_POST['basePrice']);
                $detailPackage = $_POST['detailPackage'];
                if (isset($_POST['detailPackageDeleted'])){
                    $detailPackageDeleted = $_POST['detailPackageDeleted'];
                } else {
                    $detailPackageDeleted = [];
                }

                // 1st create or update Package 
                
                $PackageBL = new PackageBL();

                if ($action == "create") {
                    $packageBEntity -> setPackageId(
                        $PackageBL -> createPackage($packageBEntity));
                    ApplicationMessage::setMessageDetail('Paquete creado correctamente.');
                }

                if ($action == "edit") {
                    $PackageBL -> updatePackage($packageBEntity);
                    ApplicationMessage::setMessageDetail('Paquete editado correctamente.');
                }

                // 2nd create or update DetailPackage

                $DetailPackageBEntity = new DetailPackageBusinessEntity();
                
                foreach ($detailPackage as $detail) {
                    $DetailPackageBEntity -> setAllFromDataRowHTTP($detail);
                    $DetailPackageBEntity -> setPackageId($packageBEntity -> getPackageId());

                    if($DetailPackageBEntity -> getDetailPackageId() == -1){
                        $PackageBL -> createDetailPackage($DetailPackageBEntity);
                    } else {
                        $PackageBL -> updateDetailPackage($DetailPackageBEntity);
                    }
                }

                foreach ($detailPackageDeleted as $detailPackageId) {
                    $PackageBL -> deleteDetailPackage($detailPackageId);
                }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        } 
        return response()->json(ApplicationMessage::toArray());
    }

    public function getDetailPackage($packageId)
    {
        try {
            $PackageBL = new PackageBL();
            $detailPackage = $PackageBL -> getDetailPackage($packageId);
            return $detailPackage;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
    }

	public function getAllDetailPackages(){
        try{
            $PackageBL = new PackageBL();
            $detailPackages = $PackageBL->getAllDetailPackages() ;
            return response()->json($detailPackages);
        }catch(Exception $e){
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
    }

	public function getIfPackageIsUsed($packageId)
    {
        try {

            $PackageBL = new PackageBL();
            $isUsed = $PackageBL -> getIfPackageIsUsed($packageId);
            return $isUsed;

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
    }
} 