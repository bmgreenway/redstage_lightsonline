<?php

class AW_Facebook_Connect_Model_System_Config_Source_Orderstatus
{
    public function toOptionArray()
    {
        return Mage::getSingleton('sales/order_config')->getStatuses();
    }

}