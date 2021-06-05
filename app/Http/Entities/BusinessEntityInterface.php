<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 27/06/2015
 * Time: 22:28
 */
namespace App\Http\Entities;

interface BusinessEntityInterface{
    //public function getDataFromHTTPRequest($http);
    public function setAllFromDataRowDB($dataRowDB);
    public function setAllFromDataRowHTTP($dataRowHTTP);
    public function validate($validationType);
}