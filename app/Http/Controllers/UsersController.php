<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Entities\ApplicationMessage;
use App\Http\Entities\CustomizerViewBusinessEntity;
use App\Http\Entities\UsersBusinessEntity;
use App\Http\Business\UsersBL;



class UsersController extends Controller
{
    /**
     * Show a list of users
     * @return \Illuminate\View\View
     */
    public function __construct()
    {

        $this->middleware('auth', ['except => getLogout']);
    }
    public function index()
    {
        $usersBL = new UsersBL();
        $users = $usersBL -> all();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show a page of user creation
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $usersList = array(
            'id' => 0,
            'name' => '',
            'password' => '',
            'email' => '',
            'role_id' => '1',
        );

        $action = 'create';
        $roles = Role::pluck('title', 'id');

        return view('admin.users.edit', compact('action','usersList','roles'));
    }

    /**
     * Insert new user into the system
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendDataUsers($action,Request $request)
    {


        try {
            $usersBEntity = new UsersBusinessEntity();
            $usersBEntity -> setAllFromDataRowHTTPBase($request->all());

            $usersBL = new UsersBL();
            if ($action == "create") {
                $usersBL -> createUsers($usersBEntity);
                ApplicationMessage::setMessageDetail('Usuario creado correctamente.');
            }

            if ($action == "edit") {
                $usersBL -> updateUsers($usersBEntity);
                ApplicationMessage::setMessageDetail('Usuario editado correctamente.');
            }

        } catch (Exception $e) {
            ApplicationMessage::setErrorMessageDetail($e -> getMessage());
        }
        return response()->json(ApplicationMessage::toArray());
        //return redirect()->route('users.index')->withMessage("Usuario creado correctamente");
    }

    /**
     * Show a user edit page
     *
     * @param $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $userBL = new UsersBL();
        $usersList = $userBL->getUsers($id);


        $action="edit";
        //$usersList  = User::findOrFail($id);
        $roles = Role::pluck('title', 'id');

        return view('admin.users.edit', compact('usersList', 'roles','action'));
    }

    /**
     * Update our user information
     *
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\RedirectResponse

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user->update($input);

        return redirect()->route('users.index')->withMessage("Usuario actualizado correctamente");
    } */

    /**
     * Destroy specific user
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {


            $userBL=new UsersBL();
            $userBL->deleteUsers($id);



        return redirect()->action('UsersController@index');
    }

}