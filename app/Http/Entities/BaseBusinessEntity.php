<?php

namespace App\Http\Entities;
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 27/06/2015
 * Time: 22:26
 */

class BaseBusinessEntity {
    private $auditoryInformation;

    /**
     * @return mixed
     */
    public function getAuditoryInformation()
    {
        return $this->auditoryInformation;
    }

    /**
     * @param mixed $auditoryInformation
     */
    public function setAuditoryInformation($auditoryInformation)
    {
        $this->auditoryInformation = $auditoryInformation;
    }

    function __construct()
    {
        $this->auditoryInformation = new AuditoryInformation();
    }

    public function toArrayBase(){
        $data = array();
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $prop->setAccessible(true);
            $data[$prop->getName()] = $prop->getValue($this);
        }
        return $data;
    }

    public function setAllFromDataRowHTTPBase($dataRowHTTP){
        $data = array();
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            if(array_key_exists($prop->getName(), $dataRowHTTP)){
                $prop->setAccessible(true);
                if($dataRowHTTP[$prop->getName()] != "")
                    $prop->setValue($this, trim($dataRowHTTP[$prop->getName()]));
                else
                    $prop->setValue($this, null);
            }
        }
        //return $data;
    }

    public function setAllFromDataRowDBBase($dataRowDB)
    {
        $data = array();
        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);

        $reflectDB = new \ReflectionClass($dataRowDB);
        $propsDB   = $reflect->getProperties();

        /*foreach ($propsDB as $propDB) {
            $propDB->setAccessible(true);
            echo $propDB->getName()."=".$propDB->getValue($dataRowDB);
        }*/
        foreach ($props as $prop) {
            $prop->setAccessible(true);
            foreach ($propsDB as $propDB) {
                $propDB->setAccessible(true);
                if($propDB->getName() == $prop->getName()){
                    $prop->setValue( $this, $propDB->getValue($dataRowDB) );
                    break;
                }
            }
        }

    }


}