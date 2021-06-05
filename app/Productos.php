<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Productos extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'productos';
    
    protected $fillable = [
          'itemId',
          'descripcion',
          'basePrice',
          'type',
          'itemNumber',
          'status',
          'itemNumCurrent'
    ];

    public static function getProductos(){
        $productos = Productos::where('type','=',1)
                    -> select('*')
                    -> get();

        return $productos;
    }

    public static function getServicios(){
        $servicios = Productos::where('type','=',0)
            -> select('*')
            -> get();

        return $servicios;
    }

    public static function boot()
    {
        parent::boot();

        Productos::observe(new UserActionsObserver);
    }
    
    
    
    
}