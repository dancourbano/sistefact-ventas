<?php

namespace App\Http\Entities;

class CommandSmsBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{
    private $commandSmsId;
    private $name;
    private $typeCommandSmsId;
    private $orderCommand; 
    

    /**
     * @param mixed $phoneId
     */
    public function setCommandSmsId($commandSmsId)
    {
        $this->commandSmsId = $commandSmsId;
    }

    /**
     * @return mixed
     */
    public function getCommandSmsId()
    {
        return $this->commandSmsId;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param mixed $name
     */
    public function setOrderCommand($orderCommand)
    {
        $this->orderCommand = $orderCommand;
    }
    /**
     * @return mixed
     */
    public function getOrderCommand()
    {
        return $this->orderCommand;
    }
    /**
     * @return mixed
     */
    /**
     * @return mixed
     */
    public function getTypeCommandSmsId()
    {
        return $this->typeCommandSmsId;
    }

    /**
     * @param mixed $typeCommandSmsId
     */
    public function setPhoneSmsId($typeCommandSmsId)
    {
        $this->typeCommandSmsId = $typeCommandSmsId;
    }

    public function setAllFromDataRowDB($dataRowDB)
    {

    }

    public function setAllFromDataRowHTTP($dataRowHTTP)
    {
        if($dataRowHTTP == null)
            return;

        if(array_key_exists('commandSmsId', $dataRowHTTP))
            $this->setCommandSmsId(trim($dataRowHTTP['commandSmsId']));

        if(array_key_exists('name', $dataRowHTTP))
            $this->setName(trim($dataRowHTTP['name']));

        if(array_key_exists('typeCommandSmsId', $dataRowHTTP))
            $this->setTypeCommandSmsId($dataRowHTTP['typeCommandSmsId']);
        if(array_key_exists('orderCommand', $dataRowHTTP))
            $this->setOrderCommand($dataRowHTTP['orderCommand']);   
    }


    function validate($validationType){}
}