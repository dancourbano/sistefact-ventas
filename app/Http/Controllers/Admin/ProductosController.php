<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Redirect;
use Schema;
use App\Productos;
use App\Http\Requests\CreateProductosRequest;
use App\Http\Requests\UpdateProductosRequest;
use Illuminate\Http\Request;



class ProductosController extends Controller {

	/**
	 * Display a listing of productos
	 *
     * @param Request $request
     *
     * @return \Illuminate\View\View
	 */
	public function index(Request $request)
    {
        //$productos = Productos::getProductos();
        $productos = Productos::all();

		return view('admin.productos.index', compact('productos'));
	}

	/**
	 * Show the form for creating a new productos
	 *
     * @return \Illuminate\View\View
	 */
	public function create()
	{
	    
	    
	    return view('admin.productos.create');
	}

	/**
	 * Store a newly created productos in storage.
	 *
     * @param CreateProductosRequest|Request $request
	 */
	public function store(CreateProductosRequest $request)
	{
	    
		Productos::create($request->all());

		return redirect()->route(config('quickadmin.route').'.productos.index');
	}

	/**
	 * Show the form for editing the specified productos.
	 *
	 * @param  int  $id
     * @return \Illuminate\View\View
	 */
	public function edit($id)
	{
		$productos = Productos::find($id);
	    
	    
		return view('admin.productos.edit', compact('productos'));
	}

	/**
	 * Update the specified productos in storage.
     * @param UpdateProductosRequest|Request $request
     *
	 * @param  int  $id
	 */
	public function update($id, UpdateProductosRequest $request)
	{
		$productos = Productos::findOrFail($id);

        

		$productos->update($request->all());

		return redirect()->route(config('quickadmin.route').'.productos.index');
	}

	/**
	 * Remove the specified productos from storage.
	 *
	 * @param  int  $id
	 */
	public function destroy($id)
	{
		Productos::destroy($id);

		return redirect()->route(config('quickadmin.route').'.productos.index');
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
            Productos::destroy($toDelete);
        } else {
            Productos::whereNotNull('id')->delete();
        }

        return redirect()->route(config('quickadmin.route').'.productos.index');
    }

}
