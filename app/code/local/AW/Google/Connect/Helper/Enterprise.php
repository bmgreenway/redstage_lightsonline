<?php

class AW_Google_Connect_Helper_Enterprise extends Mage_Core_Helper_Abstract
{
    //general settings
    public function isEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = Mage::getStoreConfig('googleconnect/general/enable_extension', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function getCallbackUrl()
    {
        $callback_url = Mage::getStoreConfig('googleconnect/general/callback_url', Mage::app()->getStore()->getId());
        return Mage::getUrl($callback_url);
    }

    public function getClientId()
    {
        static $client_id = null;
        if (is_null($client_id)) {
            $client_id = Mage::getStoreConfig('googleconnect/general/client_id', Mage::app()->getStore()->getId());
        }
        return $client_id;
    }

    public function getClientSecret()
    {
        static $client_secret = null;
        if (is_null($client_secret)) {
            $client_secret = Mage::getStoreConfig('googleconnect/general/client_secret', Mage::app()->getStore()->getId());
        }
        return $client_secret;
    }

    public function getTitle()
    {
        static $title = null;
        if (is_null($title)) {
            $title = Mage::getStoreConfig('googleconnect/general/title', Mage::app()->getStore()->getId());
        }
        return $title;
    }

    //content settings

    public function isLoginPageButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('googleconnect/content/show_in_login', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isCheckoutPageButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('googleconnect/content/show_in_checkout', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isCustomButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('googleconnect/content/show_custom', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isWidgetButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('googleconnect/content/show_widget', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    //account settings

    public function isEnableNotify()
    {
        static $enable_notify = null;
        if (is_null($enable_notify)) {
            $enable_notify = Mage::getStoreConfig('googleconnect/create_account/enable_notify', Mage::app()->getStore()->getId());
        }
        return $enable_notify;
    }

    public function getEmailTemplate()
    {
        static $email_template = null;
        if (is_null($email_template)) {
            $email_template = Mage::getStoreConfig('googleconnect/create_account/email_template', Mage::app()->getStore()->getId());
        }
        return $email_template;
    }

    public function getEmailIdentity()
    {
        static $email_identity = null;
        if (is_null($email_identity)) {
            $email_identity = Mage::getStoreConfig('googleconnect/create_account/email_identity', Mage::app()->getStore()->getId());
        }
        return $email_identity;
    }


    public function isHttps()
    {
        return Mage::app()->getStore()->isCurrentlySecure();
    }

    public function getGoogleConnection()
    {
        $connection = Mage::getSingleton('googleconnect/session');
        /* @var $connection AW_Google_Connect_Model_Session */

        if (!$connection->isInited()) {
            $connection->setClientId($this->getClientId())
                ->setClientSecret($this->getClientSecret())
                ->setRedirectUri($this->getCallbackUrl());
        }
        return $connection;
    }
}
