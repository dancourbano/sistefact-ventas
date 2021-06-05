<?php

namespace App\Http\Entities;

class TypeCommandSmsBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $typeCommandSmsId;     
    private $type;  
    private $status;
   
    /**
     * @param mixed $phoneId
     */
    public function setTypeCommandSmsId($typeCommandSmsId)
    {
        $this->typeCommandSmsId = $typeCommandSmsId;
    }

    /**
     * @return mixed
     */
    public function getTypeCommandSmsId()
    {
        return $this->typeCommandSmsId;
    }

     

    /**
     * @param mixed $tipo
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    

    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->$status;
    }



    public function setAllFromDataRowDB($dataRowDB)
    {

    }

    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('typeCommandSmsId', $dataRowHTTP))
            $this->setTypeCommandSmsId(trim($dataRowHTTP['typeCommandSmsId']));

        if(array_key_exists('type', $dataRowHTTP))
            $this->setType($dataRowHTTP['type']);

         
        if(array_key_exists('status', $dataRowHTTP))
            $this->setStatus($dataRowHTTP['status']);
    }


    function validate($validationType){}
}