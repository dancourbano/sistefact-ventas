<?php
/**
 * User: Oscar
 * Date: 31/10/16
 * Time: 19:00 PM
 */

namespace App\Http\Controllers;
use Redirect;
use Schema;
use App\Http\Business\MovementBL;
use App\Http\Entities\MovementBusinessEntity;
use App\Http\Entities\ApplicationMessage;
use Illuminate\Http\Request;

class MovementController extends Controller {
    public function index()
    {
        $MovementBL = new MovementBL();
        $movements = $MovementBL -> all();
        return view('movement.index')
            -> with(compact('movements'));
    }

    public function create()
    {
        $dataMovement = array(
            'movementId' => 0,
            'quantity' => '',
            'type' => '',
            'description' => '',
            'concept' => '',
            'sender' => '',
            'comprobanteNumber' => ''
        );

        $action = 'create';
        return view('movement.movement')
            -> with(compact('action','dataMovement'));
    }

    public function edit($movementId)
    {
        $MovementBL = new MovementBL();
        $dataMovement = $MovementBL -> getMovement($movementId);
        $action = 'edit';

        return view('movement.movement')
            -> with(compact('action','dataMovement'));
    }

    public function delete($movementId)
    {
        $MovementBL = new MovementBL();
        $MovementBL -> deleteMovement($movementId);
        return redirect()->action('MovementController@index');
    }

    public function sendDataMovement($action,Request $request)
    {
        try {
            $movementBEntity = new MovementBusinessEntity();
            $movementBEntity -> setAllFromDataRowHTTPBase($request->all());

            $MovementBL = new MovementBL();

            if ($action == "create") {
                $MovementBL -> createMovement($movementBEntity);
                ApplicationMessage::setMessageDetail('Movimiento creado correctamente.');
            }

            if ($action == "edit") {
                $MovementBL -> updateMovement($movementBEntity);
                ApplicationMessage::setMessageDetail('Movimiento editado correctamente.');
            }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
    }

    public function callData(Request $request)
    {
        $parameters = $request->all();                      // Receive the data from the ajax request

        $MovementBL = new MovementBL();                     // To processing data by parameters
        return $MovementBL -> filterMovements($parameters); // Finally return the data filtered
    }

    public function filterMovement(Request $request){
        $parameters = $request->all();                      // Receive the data from the ajax request

        $MovementBL = new MovementBL();                     // To processing data by parameters
        return $MovementBL -> filterMovementByDate($parameters); // Finally return the data filtered
    }
}