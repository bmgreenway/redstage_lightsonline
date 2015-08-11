<?php

class AW_Facebook_Connect_Model_Order extends Varien_Object
{
    protected $_facebook;

    function post($order,$observer)
    {
        try {
            if (Mage::registry('facebookconnect_post')) {
                return $this;
            }
            $this->getFacebook()->facebookPost($order,$observer);
            Mage::register('facebookconnect_post', true);
        } catch (Exception $e) {}
    }

    public function setFacebook($facebook)
    {
        $this->_facebook = $facebook;
        return $this;
    }

    public function getFacebook()
    {
        return $this->_facebook;
    }
}
