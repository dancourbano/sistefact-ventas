<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 12:51
 */

namespace App\Http\Entities;
use App\Http\Entities\BaseBusinessEntity;
use App\Http\Entities\BusinessEntityInterface;



class CustomizerViewBusinessEntity  extends BaseBusinessEntity implements BusinessEntityInterface{
    private $cssLinkClass;
    private $mode;

    /**
     * @return mixed
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * @param mixed $mode
     */
    public function setMode($mode)
    {
        $this->mode = $mode;
    }
    /**
     * @return mixed
     */
    public function getActionDescription()
    {

        return $this->actionDescription;

    }

    /**
     * @param mixed $actionDescription
     */
    public function setActionDescription($actionDescription)
    {
        $this->actionDescription = $actionDescription;
    }

    /**
     * @return mixed
     */
    public function getCssLinkClass()
    {
        return $this->cssLinkClass;
    }

    /**
     * @param mixed $cssLinkClass
     */
    public function setCssLinkClass($cssLinkClass)
    {
        $this->cssLinkClass = $cssLinkClass;
    }

    /**
     * @return mixed
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * @param mixed $disabledValue
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;
    }

    /**
     * @return mixed
     */
    public function getViewAction()
    {
        return $this->viewAction;
    }

    /**
     * @param mixed $viewAction
     */
    public function setViewAction($viewAction)
    {
        $this->viewAction = $viewAction;
    }
    private $disabled;
    private $actionDescription;
    private $viewAction;

    public function setAllFromDataRowDB($dataRowDB){}
    public function setAllFromDataRowHTTP($dataRowHTTP){}
    function validate($validationType){}
}