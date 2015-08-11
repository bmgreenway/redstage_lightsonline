<?php

class AW_Google_Connect_LoginController extends Mage_Core_Controller_Front_Action
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

        try {
            $connection = $this->_getHelper()->getGoogleConnection();

            /* @var $connection AW_Google_Connect_Model_Session */
            if (!$connection->isConnected()) {
                if ($authUrl = $connection->connect()) {
                    $this->_redirectUrl($authUrl);
                } else {
                    $this->loadLayout()->renderLayout();
                }
                return;
            }
            $return = Mage::getSingleton('customer/session')->getUrlAfterGoogleLogin();

            $customer = Mage::getModel('googleconnect/customer')
                ->setConnection($connection)
                ->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
                ->loadByGoogleEmail();

            if (!$customer->getId()) {
                $customer->create();
                echo "<script>window.opener.redirectUrl = '" . Mage::helper('customer')->getDashboardUrl() . "';</script>";
            }

            if ($customer->getId()) {
                $customer->login();
            }

            echo "<script>window.close();</script>";
            exit();

        } catch (Exception $e) {
            echo "<script>window.close();</script>";
            Mage::logException($e);
            $this->_redirectUrl(Mage::helper('customer')->getDashboardUrl());
        }
    }

    public function callbackAction()
    {
        if (Mage::helper('googleconnect')->getGoogleConnection()->callback()) {
            $this->_forward('index');
        } elseif ($this->getRequest()->getParam('error')) {
            echo "<script>window.close();</script>";
            return;
        } else {
            $this->_forward('noRoute');
        }
    }

    public function clearAction()
    {
        $this->_getHelper()->getGoogleConnection()->clearConnection();
        $this->_forward('index');
    }


    /**
     * @return AW_Google_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('googleconnect');
    }

}
