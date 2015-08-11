<?php

class AW_Facebook_Like_Model_Mysql4_Like extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('facebookilike/like', 'id');
    }

}