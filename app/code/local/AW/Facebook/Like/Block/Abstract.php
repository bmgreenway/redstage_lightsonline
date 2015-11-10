<?php

class AW_Facebook_Like_Block_Abstract extends Mage_Core_Block_Template
{
    const LIKE_URL_SUFFIX = 'like.php';
    const META_PREFIX_FB  = 'fb:';
    const META_PREFIX_OG  = 'og:';
    const LIKE_BUTTON_TAG = 'fb:like';

    protected $_isIframe = null;
    protected $_isHTML5 = null;

    static protected $CONFIG_VARS = array(
        AW_Facebook_Core_Helper_Data::VAR_LOCAL,
        AW_Facebook_Like_Helper_Data::VAR_HREF,
        AW_Facebook_Like_Helper_Data::VAR_SEND,
        AW_Facebook_Like_Helper_Data::VAR_LAYOUT,
        AW_Facebook_Like_Helper_Data::VAR_SHOW_FACES,
        AW_Facebook_Like_Helper_Data::VAR_WIDTH,
        AW_Facebook_Like_Helper_Data::VAR_HEIGHT,
        AW_Facebook_Like_Helper_Data::VAR_ACTION,
        AW_Facebook_Like_Helper_Data::VAR_COLORSCHEME,
    );

    static protected $METAS = array(
        AW_Facebook_Core_Helper_Data::VAR_APP_ID,
        AW_Facebook_Like_Helper_Data::VAR_META_TITLE,
        AW_Facebook_Like_Helper_Data::VAR_META_DESCRIPTION,
        AW_Facebook_Like_Helper_Data::VAR_META_TYPE,
        AW_Facebook_Like_Helper_Data::VAR_META_URL,
        AW_Facebook_Like_Helper_Data::VAR_META_IMAGE,
        AW_Facebook_Like_Helper_Data::VAR_META_SITE_NAME,
        AW_Facebook_Core_Helper_Data::VAR_ADMINS
    );


    public function getAttribute($name)
    {
        $value = null;
        switch ($name){
            case AW_Facebook_Core_Helper_Data::VAR_LOCAL:
                $value = $this->_getHelper()->getLocaleCode();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_HREF:
                $value = $this->_getHelper()->getUrlToLike();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_SEND:
                $value = $this->_getHelper()->isSendMode();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_LAYOUT:
                $value = $this->_getHelper()->getLayoutStyle();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_SHOW_FACES:
                $value = $this->_getHelper()->isShowFaces();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_WIDTH:
                $value = $this->_getHelper()->getWidth();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_HEIGHT:
                $value = $this->_getHelper()->getHeight();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_ACTION:
                $value = $this->_getHelper()->getDisplayStyle();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_COLORSCHEME:
                $value = $this->_getHelper()->getColorscheme();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_META_TITLE:
                $value = $this->_getHelper()->getMetaTitle();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_META_TYPE:
                $value = $this->_getHelper()->getMetaType();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_META_URL:
                $value = $this->_getHelper()->getMetaUrl();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_META_IMAGE:
                $value = $this->_getHelper()->getMetaImage();
                break;

            case AW_Facebook_Like_Helper_Data::VAR_META_SITE_NAME:
                $value = $this->_getHelper()->getMetaSiteName();
                break;

            case AW_Facebook_Core_Helper_Data::VAR_ADMINS:
                $value = $this->_getHelper()->getAdmins();
                break;

            case AW_Facebook_Core_Helper_Data::VAR_APP_ID:
                $value = $this->_getHelper()->getAppID();
                break;
        }

        return $value;
    }



    public function isIframe()
    {
        if (is_null($this->_isIframe)) {
            $this->_isIframe = ($this->_getHelper()->getPluginCode() == 'iframe');
        }

        return $this->_isIframe;
    }

    public function isHTML5()
    {
        if (is_null($this->_isHTML5)) {
            $this->_isHTML5 = ($this->_getHelper()->getPluginCode() == 'html5');
        }
        return $this->_isHTML5;
    }


    public function getTag()
    {
        if ($this->isIframe()) {
            return 'iframe';
        } elseif ($this->isHTML5()) {
            return 'div';
        } else {
            return self::LIKE_BUTTON_TAG;
        }
    }

    public function getTagParams()
    {
        if ($this->isIframe()) {
            return $this->getIframeParams();
        } elseif ($this->isHTML5()) {
            return $this->getHTML5Params();
        } else {
            return $this->getXfbmlParams();

        }
    }

    public function getHTML5Params()
    {
        $params = array();
        foreach (self::$CONFIG_VARS as $var) {
            if ($var != AW_Facebook_Core_Helper_Data::VAR_LOCAL) {
                $value    = $this->getAttribute($var);
                $params[] = 'data-' . $var . '="' . $value . '"';
            }
        }
        array_unshift($params, 'class="fb-like"');
        return implode(' ', $params);
    }


    public function getIframeParams()
    {
        $width  = $this->getAttribute(AW_Facebook_Like_Helper_Data::VAR_WIDTH);
        $height = $this->getAttribute(AW_Facebook_Like_Helper_Data::VAR_HEIGHT);

        $params_array = array(
            'src'               => $this->getIframeSrc(),
            'scrolling'         => 'no',
            'frameborder'       => '0',
            'style'             => 'border:none; overflow:hidden;' . ($width ? ' width:' . $width . 'px;' : '') . ($height ? ' height:' . $height . 'px;' : ''),
            'allowTransparency' => 'true',
        );

        $params = array();
        foreach ($params_array as $param_key => $param_value) {
            $params[] = $param_key . '="' . $param_value . '"';
        }

        return implode(' ', $params);
    }

    public function getIframeSrc()
    {
        return $this->_getHelper()->getFacebook()->getPluginsUrl(). self::LIKE_URL_SUFFIX . '?' . implode('&amp;', $this->_getParamsString());
    }

    public function getXfbmlParams()
    {
        return implode(' ', $this->_getParamsString());
    }

    protected function _getParamsString()
    {
        $isFrame = $this->isIframe();

        $vars = array();
        foreach (self::$CONFIG_VARS as $var) {
            $value = $this->getAttribute($var);
            if ($isFrame) {
                $vars[] = $var . '=' . $value;
            } else {
                $vars[] = $var . '="' . $value . '"';
            }
        }

        return $vars;
    }


    protected function _getMetaTagsContent($property, $content)
    {
        return $content;
    }

    public function getMetaTagsParams()
    {
        $params = array();
        foreach (self::$METAS as $meta) {
            if ($this->_getHelper()->checkMetaTag($meta)) {
                continue;
            }

            $content = $this->_getMetaTagsContent($meta, $this->getAttribute($meta));

            switch ($meta) {
                case (AW_Facebook_Core_Helper_Data::VAR_ADMINS):
                case (AW_Facebook_Core_Helper_Data::VAR_APP_ID):
                    $params[self::META_PREFIX_FB . $meta] = $content;
                    break;

                case (AW_Facebook_Like_Helper_Data::VAR_META_TITLE):
                    $content = $content ? $content : $this->getParentBlock()->getTitle();

                case (AW_Facebook_Like_Helper_Data::VAR_META_SITE_NAME):
                    $content = $content ? $content : Mage::getStoreConfig('general/store_information/name', Mage::app()->getStore());

                case (AW_Facebook_Like_Helper_Data::VAR_META_URL):
                    $content = $content ? $content : $this->_getHelper()->getCurrentUrlWithStorePort();

                case (AW_Facebook_Like_Helper_Data::VAR_META_IMAGE):
                    $content = $content ? $content : Mage::getDesign()->getSkinUrl(Mage::getStoreConfig('design/header/logo_src'));

                case (AW_Facebook_Like_Helper_Data::VAR_META_DESCRIPTION):
                    $content = $content ? $content : $this->getParentBlock()->getDescription();

                default:
                    $params[self::META_PREFIX_OG . $meta] = $content;
            }

            $this->_getHelper()->addMetaTag($meta);
        }

        return $params;
    }

    public function getUrlToLike()
    {
        return $this->_getHelper()->getUrlToLike();
    }

    /**
     * @return AW_Facebook_Like_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookilike');
    }
}
