<?php

class AW_Facebook_Connect_Block_Form extends Mage_Core_Block_Template
{
    public function __construct()
    {
        $this->setTemplate('facebookconnect/form.phtml');
    }

    public function getConnectUrl()
    {
        return $this->_getHelper()->getFacebook()->getConnectUrl();
    }

    public function getConnectType()
    {
        return AW_Facebook_Connect_Model_Connect::FBCONNECTTYPE;
    }

    /**
     * @return AW_Facebook_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookconnect');
    }


}