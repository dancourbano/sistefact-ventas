<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 16/11/2016
 * Time: 11:51
 */

namespace App\Http\Entities;


class UsersBusinessEntity extends BaseBusinessEntity implements BusinessEntityInterface{
    private $id;
    private $name;
    private $password;
    private $email;
    private $remember_token;
    private $role_id;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * @param mixed $remember_token
     */
    public function setRememberToken($remember_token)
    {
        $this->remember_token = $remember_token;
    }
    private $created_at;
    private $update_at;

    /**
     * @return mixed
     */
    public function getUpdateAt()
    {
        return $this->update_at;
    }

    /**
     * @param mixed $update_at
     */
    public function setUpdateAt($update_at)
    {
        $this->update_at = $update_at;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param mixed $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return mixed
     */
    public function getRoleId()
    {
        return $this->role_id;
    }

    /**
     * @param mixed $role_id
     */
    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }

    public function setAllFromDataRowDB($dataRowDB)
    {

    }
    public function setAllFromDataRowHTTP($dataRowHTTP)
    {


        if($dataRowHTTP == null)
            return;
        if(array_key_exists('id', $dataRowHTTP))
            $this->setId(trim($dataRowHTTP['id']));
        if(array_key_exists('name', $dataRowHTTP))
            $this->setName($dataRowHTTP['name']);
        if(array_key_exists('email', $dataRowHTTP))
            $this->setEmail($dataRowHTTP['email']);
        if(array_key_exists('remember_token', $dataRowHTTP))
            $this->setRememberToken($dataRowHTTP['remember_token']);

        if(array_key_exists('password', $dataRowHTTP))
            $this->setPassword($dataRowHTTP['password']);
        if(array_key_exists('role_id', $dataRowHTTP))
            $this->setRoleId($dataRowHTTP['role_id']);
        if(array_key_exists('created_at', $dataRowHTTP))
            $this->setCreatedAt($dataRowHTTP['created_at']);
        if(array_key_exists('updated_at', $dataRowHTTP))
            $this->setUpdateAt($dataRowHTTP['updated_at']);
    }


    function validate($validationType){}

}