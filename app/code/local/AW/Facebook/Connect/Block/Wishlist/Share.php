<?php

class AW_Facebook_Connect_Block_Wishlist_Share extends Mage_Core_Block_Template
{

    public function __construct()
    {
        parent::__construct();
    }

    public function _toHtml()
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customer     = Mage::getSingleton('customer/session')->getCustomer();
            $access_token = $customer->getFbAccessToken();
            $count = Mage::helper('wishlist')->getItemCount();
            if ($access_token && $this->_getHelper()->isShareWishlistButtonEnabled()
                && Mage::helper('facebookcore')->checkApp() && $count
            ) {
                $this->setTemplate('facebookconnect/wishlist/share.phtml');
                return parent::_toHtml();
            }
        }
        return false;
    }

    /**
     * @return AW_Facebook_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookconnect');
    }

}