<?php

class AW_Facebook_Connect_Block_Customer_Form_Facebookconnect extends Mage_Customer_Block_Account_Dashboard
{

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('facebookconnect/customer/form/facebookconnect.phtml');
    }

    public function getIsPostToFBWall()
    {
        return Mage::helper('facebookconnect')->isPostEnabled();
    }

    public function getAction()
    {
        return $this->getUrl('*/*/save', array('_secure' => Mage::helper('facebookconnect')->isHttps()));
    }

}
