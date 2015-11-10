<?php

class AW_Facebook_Connect_LoginController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        if (!$this->_getHelper()->isEnabled()) {
            $this->_forward('noRoute');
            return;
        }

        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $this->_redirectUrl(Mage::helper('customer')->getDashboardUrl());
            return;
        }

        $isPopup = $this->getRequest()->getParam(AW_Facebook_Connect_Model_Connect::FBCONNECTTYPE) ? false : true;

        try {
            $facebook = $this->_getHelper()->getFacebook();
            if (!$facebook->getUserInfo()) {
                $facebook = $facebook->getFacebookAfterLogin();
            }

            if (!$facebook->getUserInfo()) {
                $redirectUrl = $facebook->getConnectUrl(null);
                $this->_redirectUrl($redirectUrl);
                return;
            }

            $customer = Mage::getModel('facebookconnect/customer')
                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                ->setFacebook($facebook)
                ->loadByFacebookEmail();

            if (!$customer->getId()) {
                $customer->create();
            }

            if ($customer->getId()) {
                $customer->login();
            }

            $this->_getHelper()->updateCustomerToken($facebook->getFacebook()->getAccessToken());
            $return = Mage::getSingleton('customer/session')->getUrlAfterFacebookLogin();


            if ($isPopup) {
                echo '<script>window.opener.location.reload();</script>';
            } else {
                $url = $return ? $return : Mage::helper('customer')->getDashboardUrl();
                $this->_redirectUrl($url);
                return;
            }

        } catch (Exception $e) {
            Mage::logException($e);
            if ($isPopup) {
                echo '<script>window.opener.location.reload();</script>';
            } else {
                $this->_redirectUrl(Mage::helper('customer')->getDashboardUrl());
            }
        }

        if ($isPopup) {
            echo "<script>window.close();</script>";
            die();
        }

    }

    /**
     * @return AW_Facebook_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookconnect');
    }
}
