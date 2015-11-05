<?php

class AW_Facebook_Like_Model_Mysql4_Like_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('facebookilike/like', 'id');
    }

    public function getLastLike($customerId)
    {
        $this->addFieldToFilter('customer_id', array('eq' => $customerId));
        $this->setOrder('like_time', 'DESC');
        $this->getSelect()->limit(1);
        return $this->getFirstItem();
    }

    public function getLikeCount($time = 0)
    {
        $this->addFieldToFilter('like_time', array("gt" => $time));
        return $this->getCount();
    }

}