<?php

class AW_Facebook_Connect_Model_Connect extends AW_Facebook_Core_Model_Facebook
{
    const STREAM_PUBLISH     = 'stream.publish';
    const FQL_QUERY          = 'fql.query';
    const API_ME             = '/me';
    const API_ME_FEED        = '/me/feed';
    const SCOPE              = 'email,publish_actions';
    const CONNECT_URL        = 'https://www.facebook.com/dialog/oauth/?client_id=%1$s&redirect_uri=%2$s&state=%3$s&scope=%4$s&display=%5$s';
    const ACCESS_URL         = 'https://graph.facebook.com/oauth/access_token?client_id=%1$s&client_secret=%2$s&redirect_uri=%3$s&code=%4$s';
    const DISPLAY_MODE_POPUP = 'popup';
    const FBCONNECTTYPE      = 'fbconnecttype';


    public function init($reset = null, $check_cookie = true, $log = true)
    {
        parent::init($reset = null);
        if (!$check_cookie || ($key = $this->getAppId()) && array_key_exists('fbsr_' . $key, $_COOKIE)) {
            try {
                $me = $this->getFacebook()->api(self::API_ME);
                $this->setUserInfo($me);
            } catch (FacebookApiException $e) {
            }
        }
        return $this;
    }

    public function getConnectUrl($mode = self::DISPLAY_MODE_POPUP)
    {
        $facebook = $this->getFacebook();
        $isSecure = $this->_getHelper()->isHttps();
        $redirect = Mage::getUrl('facebookconnect/login', array('_secure' => $isSecure));
        if ($mode != self::DISPLAY_MODE_POPUP) {
            $redirect = $redirect . (strpos($redirect, '?') !== FALSE ? '&' : '?') . self::FBCONNECTTYPE . '=page';
        }
        $params = array(
            'scope'        => self::SCOPE,
            'redirect_uri' => $redirect
        );
        if ($mode) {
            $params['display'] = $mode;
        }
        return $facebook->getLoginUrl($params);
    }

    public function getFacebookAfterLogin()
    {
        $facebook = $this->getFacebook();
        if ($user = $facebook->getUser()) {
            $this->init(null, false);
            $this->_getHelper()->getFacebook($this);
        }
        return $this;
    }

    public function facebookPost($order, $observer)
    {
        $facebookconnect_session = Mage::getSingleton('facebookconnect/session');

        if ($facebookconnect_session->checkPost($order->getEntityId())) {
            return $this;
        }
        $customer_email = $order->getCustomerEmail();
        $customer       = Mage::getModel('customer/customer')
            ->setWebsiteId(Mage::app()->getStore($order->getStoreId())->getWebsiteId())
            ->loadByEmail($customer_email);
        $access_token   = $customer->getFbAccessToken();
        $facebook       = $this->getFacebook()->setAccessToken($access_token);
        $session        = $facebook->getUser();

        if ($session) {
            try {
                $param = $this->_getHelper()->getPostMessage($order);
                $params = new Varien_Object($param);
                Mage::dispatchEvent(
                    'aw_fbintegrator_order_wall_post_before',
                    array('params' => $params, 'observer' => $observer)
                );
                $param = $params->toArray();
                $facebook->api($param);
            } catch (Exception $e) {
            }
        }
        return $this;
    }


    public function facebookPostSingup()
    {
        $params                = array();
        $params['link']        = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        $params['message']     = $this->_getHelper()->getSignupMessage();
        $params['picture']     = $this->_getHelper()->getSignupImage();
        $params['name']        = $this->_getHelper()->getSignupName();
        $params['description'] = $this->_getHelper()->getSignupDescription();

        return $this->getFacebook()->api(self::API_ME_FEED, 'post', $params);
    }

    public function getFacebookLoginEventHtml()
    {
        $facebook = $this->getFacebook();
        if (!($facebook instanceof Facebook)) {
            return '';
        }

        $html = Mage::getSingleton('core/layout')->createBlock('facebookconnect/form','facebookcore')->setFacebook($facebook)->toHtml();
        return $html;
    }

    /**
     * @return AW_Facebook_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookconnect');
    }
}