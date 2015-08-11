<?php

class AW_Facebook_Like_Helper_Data extends AW_Facebook_Core_Helper_Data
{
    const SECRET_CODE_SALT     = 'f5Ybd1';
    const VAR_HREF             = 'href';
    const VAR_SEND             = 'send';
    const VAR_LAYOUT           = 'layout';
    const VAR_SHOW_FACES       = 'show_faces';
    const VAR_WIDTH            = 'width';
    const VAR_HEIGHT           = 'height';
    const VAR_ACTION           = 'action';
    const VAR_COLORSCHEME      = 'colorscheme';
    const VAR_META_TITLE       = 'title';
    const VAR_META_DESCRIPTION = 'description';
    const VAR_META_TYPE        = 'type';
    const VAR_META_URL         = 'url';
    const VAR_META_IMAGE       = 'image';
    const VAR_META_SITE_NAME   = 'site_name';

    public function getUrlSecretCode($url = null)
    {
        if ($url === null) {
            $url = Mage::app()->getRequest()->getServer("REQUEST_URI");
        }
        $a = parse_url($url, PHP_URL_PATH);
        $a = md5(md5(self::SECRET_CODE_SALT . $a));
        return $a;
    }

    //general settings

    public function getPluginCode()
    {
        return Mage::getStoreConfig('facebookilike/general/plugin_code', Mage::app()->getStore()->getId());
    }

    public function getUrlToLike()
    {
        $url = Mage::getStoreConfig('facebookilike/general/href', Mage::app()->getStore()->getId());
        return $url ? $url: Mage::helper('core/url')->getCurrentUrl();
    }

    public function isSendMode()
    {
        return Mage::getStoreConfig('facebookilike/general/send', Mage::app()->getStore()->getId());
    }

    public function getLayoutStyle()
    {
        return Mage::getStoreConfig('facebookilike/general/layout', Mage::app()->getStore()->getId());
    }

    public function isShowFaces()
    {
        return Mage::getStoreConfig('facebookilike/general/show_faces', Mage::app()->getStore()->getId());
    }

    public function getWidth()
    {
        return Mage::getStoreConfig('facebookilike/general/width', Mage::app()->getStore()->getId());
    }

    public function getHeight()
    {
        return Mage::getStoreConfig('facebookilike/general/height', Mage::app()->getStore()->getId());
    }

    public function getDisplayStyle()
    {
        return Mage::getStoreConfig('facebookilike/general/action', Mage::app()->getStore()->getId());
    }

    public function getColorscheme()
    {
        return Mage::getStoreConfig('facebookilike/general/colorscheme', Mage::app()->getStore()->getId());
    }

    public function getMetaTitle()
    {
        return Mage::getStoreConfig('facebookilike/general/title', Mage::app()->getStore()->getId());
    }

    public function getMetaType()
    {
        return Mage::getStoreConfig('facebookilike/general/type', Mage::app()->getStore()->getId());
    }

    public function getMetaUrl()
    {
        return Mage::getStoreConfig('facebookilike/general/url', Mage::app()->getStore()->getId());
    }

    public function getMetaImage()
    {
        return Mage::getStoreConfig('facebookilike/general/image', Mage::app()->getStore()->getId());
    }

    public function getMetaSiteName()
    {
        return Mage::getStoreConfig('facebookilike/general/site_name', Mage::app()->getStore()->getId());
    }

    //content settings

    public function isShowInCms()
    {
        return Mage::getStoreConfig('facebookilike/content/show_in_cms', Mage::app()->getStore()->getId());
    }

    public function isShowInHome()
    {
        return Mage::getStoreConfig('facebookilike/content/show_in_home', Mage::app()->getStore()->getId());
    }

    public function isShowOnProductPage()
    {
        return Mage::getStoreConfig('facebookilike/content/show_in_product', Mage::app()->getStore()->getId());
    }

    public function isShowInCategoryPage()
    {
        return Mage::getStoreConfig('facebookilike/content/show_in_category', Mage::app()->getStore()->getId());
    }

    public function isShowCustom()
    {
        return Mage::getStoreConfig('facebookilike/content/show_custom', Mage::app()->getStore()->getId());
    }

    public function isShowWidget()
    {
        return Mage::getStoreConfig('facebookilike/content/show_widget', Mage::app()->getStore()->getId());
    }

    //point settings

    public function canGetPoints()
    {
        $pointsForLike      = Mage::helper('facebookilike')->getPoints();
        $isPointsExtEnabled = Mage::getConfig()->getModuleConfig('AW_Points')->is('active', 'true');
        if ($pointsForLike && $isPointsExtEnabled && Mage::getSingleton('customer/session')->isLoggedIn()) {
            return true;
        }
        return false;
    }

    public function getPoints()
    {
        $points = intval(Mage::getStoreConfig('points/earning_points/fb_like_points'));
        return $points;
    }

    public function getDelay()
    {
        return intval(Mage::getStoreConfig('points/earning_points/fb_like_delay'));
    }

    public function getMaxCount()
    {
        return intval(Mage::getStoreConfig('points/earning_points/fb_like_max_like_count'));
    }

    public function getTime()
    {
        return intval(Mage::getStoreConfig('points/earning_points/fb_like_time'));
    }

    public function isAlreadyLiked($url, $customerId = null)
    {
        if ($customerId === null) {
            if (!Mage::getSingleton('customer/session')->isLoggedIn()) {
                return false;
            }
            $customerId = Mage::getSingleton('customer/session')->getCustomer()->getId();
        }
        $like_model = Mage::getModel('facebookilike/like');
        return $like_model->isAlreadyLiked($customerId, $url);
    }

    public function getCurrentUrlWithStorePort()
    {
        $baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
        if (Mage::app()->getStore()->isCurrentlySecure()) {
            $baseUrl = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB, TRUE);
        }
        $storePort = parse_url($baseUrl, PHP_URL_PORT);
        $request = Mage::app()->getRequest();
        $url = $request->getScheme()
            . '://' . $request->getHttpHost()
            . ($storePort ? ':' . $storePort : '')
            . $request->getServer('REQUEST_URI')
        ;

        $url = Mage::getSingleton('core/url')->escape($url);
        return $url;
    }

    public function getTimeToWait($customerId)
    {
        $timeToWait = 0;
        $delay      = $this->getDelay();
        if ($delay) {
            $now        = Mage::getModel('core/date')->gmtTimestamp();
            $lastLike   = Mage::getModel('facebookilike/like')
                ->getCollection()
                ->getLastLike($customerId);
            $timeToWait = max(0, $lastLike->getLikeTime() + $delay - $now);
        }
        return $timeToWait;
    }

    public function limitLikesPerTimeReached($customerId)
    {
        $maxLikeCount = $this->getMaxCount();
        $time         = $this->getTime();
        if ($maxLikeCount && $time) {
            $now       = Mage::getModel('core/date')->gmtTimestamp();
            $likeCount = Mage::getModel('facebookilike/like')->getCollection()
                ->addFieldToFilter('customer_id', array("eq" => $customerId))
                ->addFieldToFilter('like_time', array("gt" => ($now - $time)))
                ->getSize();
            if ($likeCount >= $maxLikeCount) {
                return true;
            }
        }
        return false;
    }

}
