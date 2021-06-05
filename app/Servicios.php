<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Servicios extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'servicios';
    
    protected $fillable = [
          'itemId',
          'descripcion',
          'basePrice',
          'type',
          'itemNumber',
          'itemNumCurrent'
    ];
    

    public static function boot()
    {
        parent::boot();

        Servicios::observe(new UserActionsObserver);
    }
    
    
    
    
}