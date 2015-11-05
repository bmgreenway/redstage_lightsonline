<?php

class AW_Twitter_Connect_Helper_Enterprise extends Mage_Core_Helper_Abstract
{
    const VAR_ENABLE_EXTENSION	= 'enable_extension';
    const VAR_CALLBACK_URL		= 'callback_url';
    const VAR_CONSUMER_KEY		= 'consumer_key';
    const VAR_CONSUMER_SECRET	= 'consumer_secret';

    //general settings

    public function isEnabled()
    {
        static $is_enabled = null;
        if(is_null($is_enabled)) {
            $is_enabled = Mage::getStoreConfig('twitterconnect/general/enable_extension', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function getConsumerKey()
    {
        static $consumer_key = null;
        if (is_null($consumer_key)) {
            $consumer_key = Mage::getStoreConfig('twitterconnect/general/consumer_key', Mage::app()->getStore()->getId());
        }
        return $consumer_key;
    }

    public function getCallBackUrl()
    {
        static $callback_url = null;
        if (is_null($callback_url)) {
            $callback_url = Mage::getStoreConfig('twitterconnect/general/callback_url', Mage::app()->getStore()->getId());
        }
        $callback_url = (strtolower(substr($callback_url,0,4)) === 'http') ? $callback_url : Mage::getUrl($callback_url);

        return $callback_url;
    }

    public function getConsumerSecret()
    {
        static $consumer_secret = null;
        if (is_null($consumer_secret)) {
            $consumer_secret = Mage::getStoreConfig('twitterconnect/general/consumer_secret', Mage::app()->getStore()->getId());
        }
        return $consumer_secret;
    }

    public function getTitle()
    {
        static $title = null;
        if (is_null($title)) {
            $title = Mage::getStoreConfig('twitterconnect/general/title', Mage::app()->getStore()->getId());
        }
        return $title;
    }

    public function getOrderStatus()
    {
        static $orderstatus = null;
        if (is_null($orderstatus)) {
            $orderstatus = Mage::getStoreConfig('twitterconnect/general/orderstatus', Mage::app()->getStore()->getId());
        }
        return $orderstatus;
    }

    //content settings

    public function isLoginPageButtonEnabled()
    {
        static $is_enabled = null;
        if(is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('twitterconnect/content/show_in_login', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isCheckoutPageButtonEnabled()
    {
        static $is_enabled = null;
        if(is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('twitterconnect/content/show_in_checkout', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isCustomButtonEnabled()
    {
        static $is_enabled = null;
        if(is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('twitterconnect/content/show_custom', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isWidgetButtonEnabled()
    {
        static $is_enabled = null;
        if(is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('twitterconnect/content/show_widget', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isPostEnabled($order = null)
    {
        if (!Mage::app()->getStore()->isAdmin()) {
            return (Mage::getSingleton('customer/session')->getCustomer()->getData('twitter_post') ? true : false);
        } else {
            if (!($customerId = $order->getCustomerId())
                || !($customer = Mage::getModel('customer/customer')->setWebsiteId(Mage::app()->getStore()->getWebsiteId())->load($customerId))
                || !($customer instanceof Mage_Customer_Model_Customer)) {
                return false;
            }
            return ($customer->getData('twitter_post') ? true : false);
        }
    }

    public function getPostOrderStatus()
    {
        if (!$orderstatus = $this->getOrderStatus()) {
            return Mage_Sales_Model_Order::STATE_COMPLETE;
        }
        return $orderstatus;
    }

    public function getTwitterConnection()
    {
        $connection = Mage::getSingleton('twitterconnect/session');
        /* @var $connection AW_Twitter_Connect_Model_Session*/

        if(!$connection->isInited()) {
            $connection->setConsumerKey($this->getConsumerKey())
                ->setConsumerSecret($this->getConsumerSecret())
                ->setCallbackUrl($this->getCallBackUrl());
        }

        return $connection;
    }
}