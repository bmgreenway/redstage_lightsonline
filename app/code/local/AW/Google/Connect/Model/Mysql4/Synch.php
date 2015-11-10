<?php

class AW_Google_Connect_Model_Mysql4_Synch extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('googleconnect/synch', 'synch_id');
    }
}