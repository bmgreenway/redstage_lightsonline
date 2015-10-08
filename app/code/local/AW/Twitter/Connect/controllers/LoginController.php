<?php

class AW_Twitter_Connect_LoginController extends Mage_Core_Controller_Front_Action
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
			$connection = $this->_getHelper()->getTwitterConnection();
			/* @var $connection AW_Twitter_Connect_Model_Session */
			if (!$connection->isConnected()) {
				$url = $connection->connect();
				Mage::register('twitter_auth_url', $url);
				$this->loadLayout()->renderLayout();
				return $this;
			}

			$customer = Mage::getModel('twitterconnect/customer')
					->setConnection($connection)
					->setWebsiteId(Mage::app()->getStore()->getWebsiteId())
					->loadByTwitterUserId();

			if (!$customer->getId()) {
				$customer->create();
				Mage::getSingleton('customer/session')->addError($this->_getHelper()->__('Please insert you email, otherwhise system will remember your Twitter screenname only and you will not be able to enjoy all shop features.Remember to change your password.'));
				echo "<script>window.opener.redirectUrl = '" . Mage::helper('customer')->getEditUrl() . "';</script>";
			}

			if ($customer->getId()) {
				$customer->login();
			}
			echo "<script>window.close();</script>";
			exit();

		} catch (Exception $e) {
			echo "<script>window.close();</script>";
			Mage::logException($e);
			$message = $this->_getHelper()->__('Cannot login via Twitter!');
			Mage::getSingleton('customer/session')->addError($message);
			$this->_redirectUrl(Mage::helper('customer')->getDashboardUrl());
		}
	}

	public function callbackAction()
	{
		if ($this->_getHelper()->getTwitterConnection()->callback()) {
			$this->_forward('index');
		}
	}

	public function clearAction()
	{
		$this->_getHelper()->getTwitterConnection()->clearConnection();
		$this->_forward('index');
	}


    /**
     * @return AW_Twitter_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('twitterconnect');
    }


}
