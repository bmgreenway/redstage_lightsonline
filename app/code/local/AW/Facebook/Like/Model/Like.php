<?php

class AW_Facebook_Like_Model_Like extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        parent::_construct();
        $this->_init('facebookilike/like', 'id');
    }

    public function getStoredLike($customerId, $url)
    {
        $like = $this->getCollection()
            ->addFieldToFilter('customer_id', $customerId)
            ->addFieldToFilter('url', $url)
            ->getFirstItem();
        return $like;
    }

    public function isAlreadyLiked($customerId, $url)
    {
        $like = $this->getStoredLike($customerId, $url);
        return (bool)$like->getId();
    }

}