<?php
/**
 * Created by PhpStorm.
 * User: DANIEL
 * Date: 10/10/2016
 * Time: 12:59
 */

namespace App\Http\Entities;





class ApplicationMessage {
    private static $messageType = "S";

    /**
     * @return mixed
     */
    public static function getMessageDetail()
    {
        return self::$messageDetail;
    }

    /**
     * @param mixed $messageDetail
     */
    public static function setMessageDetail($messageDetail)
    {
        self::$messageDetail = $messageDetail;
    }

    public static function setErrorMessageDetail($messageDetail)
    {
        self::$messageDetail = $messageDetail;
        self::$messageType = "E";
    }

    /**
     * @return mixed
     */
    public static function getMessageId()
    {
        return self::$messageId;
    }

    /**
     * @param mixed $messageId
     */
    public static function setMessageId($messageId)
    {
        self::$messageId = $messageId;
    }

    /**
     * @return mixed
     */
    public static function getMessageType()
    {
        return self::$messageType;
    }

    /**
     * @param mixed $messageType
     */
    public static function setMessageType($messageType)
    {
        self::$messageType = $messageType;
    }
    /**
     * @return mixed
     */
    public static function getExtraValue()
    {
        return self::$extraValue;
    }

    /**
     * @param mixed $messageType
     */
    public static function setExtraValue($extraValue)
    {
        self::$extraValue = $extraValue;
    }



    public static function getId()
    {
        return self::$id;
    }

    /**
     * @param mixed $messageType
     */
    public static function setId($id)
    {
        self::$id = $id;
    }
    public static function getName()
    {
        return self::$name;
    }

    /**
     * @param mixed $messageType
     */
    public static function setName($name)
    {
        self::$name = $name;
    }
    private static $messageDetail;
    private static $messageId = "M0";
    private static $extraValue;
    private static $id;
    private static $name;

    public static function toArray(){
        $arr['messageId'] = ApplicationMessage::getMessageId();
        $arr['messageType'] = ApplicationMessage::getMessageType();
        $arr['messageDetail'] = ApplicationMessage::getMessageDetail();
        $arr['extraValue'] = ApplicationMessage::getExtraValue();
        $arr['id'] = ApplicationMessage::getId();
        $arr['name'] = ApplicationMessage::getName();
        return $arr;
    }

}