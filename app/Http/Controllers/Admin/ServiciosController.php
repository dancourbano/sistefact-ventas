<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Servicios;
use App\Productos;
use App\Http\Requests\CreateServiciosRequest;
use App\Http\Requests\UpdateServiciosRequest;
use Illuminate\Http\Request;



class ServiciosController extends Controller {

	/**
	 * Display a listing of servicios
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        //$servicios = Productos::getServicios();
        $servicios = Servicios::all();

		return view('admin.servicios.index', compact('servicios'));
	}

	/**
	 * Show the form for creating a new servicios
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    return view('admin.servicios.create');
	}

	/**
	 * Store a newly created servicios in storage.
	 *
     * @param CreateServiciosRequest|Request $request
	 */
	public function store(CreateServiciosRequest $request)
	{
	    
		Servicios::create($request->all());

		return redirect()->route(config('quickadmin.route').'.servicios.index');
	}

	/**
	 * Show the form for editing the specified servicios.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$servicios = Servicios::find($id);
	    
	    
		return view('admin.servicios.edit', compact('servicios'));
	}

	/**
	 * Update the specified servicios in storage.
     * @param UpdateServiciosRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateServiciosRequest $request)
	{
		$servicios = Servicios::findOrFail($id);

        

		$servicios->update($request->all());

		return redirect()->route(config('quickadmin.route').'.servicios.index');
	}

	/**
	 * Remove the specified servicios from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Servicios::destroy($id);

		return redirect()->route(config('quickadmin.route').'.servicios.index');
	}

    /**
     * Mass delete function from index page
     * @param Request $request
     *
     * @return mixed
     */
    public function massDelete(Request $request)
    {
        if ($request->get('toDelete') != 'mass') {
            $toDelete = json_decode($request->get('toDelete'));
            Servicios::destroy($toDelete);
        } else {
            Servicios::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.servicios.index');
    }

}
