<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 27/06/2015
 * Time: 22:31
 */
namespace App\Http\Entities;


class CustomerBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface
{

    private $customerId;
    private $name;
    private $lastName;
    private $identification;
    private $phone1;
    private $maritalStatus;
    private $email;
    private $address;
    private $city;
    private $phone2;
    private $birthday;
    private $type;

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param mixed $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * @param mixed $identificationId
     */
    public function setIdentification($identification)
    {
        $this->identification = $identification;
    }

    /**
     * @return mixed
     */
    public function getPhone1()
    {
        return $this->phone1;
    }

    /**
     * @param mixed $telephone
     */

    public function setPhone1($phone1)
    {
        $this->phone1 = $phone1;
    }

    /**
     * @return mixed
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * @param mixed $maritalStatus
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getPhone2()
    {
        return $this->phone2;
    }

    /**
     * @param mixed $phone2
     */
    public function setPhone2($phone2)
    {
        $this->phone2 = $phone2;
    }

    /**
     * @return mixed
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param mixed $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }


    public function setAllFromDataRowDB($dataRowDB)
    {

    }
    public function setAllFromDataRowHTTP($dataRowHTTP)
    {


        if($dataRowHTTP == null)
            return;
        if(array_key_exists('customerId', $dataRowHTTP))
            $this->setCustomerId(trim($dataRowHTTP['customerId']));
        if(array_key_exists('name', $dataRowHTTP))
            $this->setName($dataRowHTTP['name']);

        if(array_key_exists('lastName', $dataRowHTTP))
            $this->setLastName($dataRowHTTP['lastName']);


        if(array_key_exists('email', $dataRowHTTP))
            $this->setEmail($dataRowHTTP['email']);

        if(array_key_exists('phone1', $dataRowHTTP))
            $this->setPhone1($dataRowHTTP['phone1']);

        if(array_key_exists('maritalStatus', $dataRowHTTP))
            $this->setMaritalStatus($dataRowHTTP['maritalStatus']);

        if(array_key_exists('identification', $dataRowHTTP))
            $this->setIdentification($dataRowHTTP['identification']);

        if(array_key_exists('address', $dataRowHTTP))
            $this->setAddress($dataRowHTTP['address']);

    }


    function validate($validationType){}
}