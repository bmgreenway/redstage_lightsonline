<?php

class AW_Facebook_Subscribe_Block_Abstract extends Mage_Core_Block_Template
{
    const SUBSCRIBE_URL_SUFFIX = 'subscribe.php';
    const SUBSCRIBE_BUTTON_TAG = 'fb:subscribe';

    protected $_isIframe = null;
    protected $_isHTML5 = null;

    static protected $CONFIG_VARS = array(
        AW_Facebook_Subscribe_Helper_Data::VAR_HREF,
        AW_Facebook_Subscribe_Helper_Data::VAR_WIDTH,
        AW_Facebook_Subscribe_Helper_Data::VAR_LAYOUT,
        AW_Facebook_Subscribe_Helper_Data::VAR_SHOW_FACES,
        AW_Facebook_Subscribe_Helper_Data::VAR_COLORSCHEME,
    );


    public function getAttribute($name)
    {
        $value = null;
        switch ($name){
            case AW_Facebook_Subscribe_Helper_Data::VAR_HREF:
                $value = $this->_getHelper()->getFollowUrl();
                break;

            case AW_Facebook_Subscribe_Helper_Data::VAR_WIDTH:
                $value = $this->_getHelper()->getWidth();
                break;

            case AW_Facebook_Subscribe_Helper_Data::VAR_LAYOUT:
                $value = $this->_getHelper()->getLayoutStyle();
                break;

            case AW_Facebook_Subscribe_Helper_Data::VAR_SHOW_FACES:
                $value = $this->_getHelper()->isShowFaces();
                break;

            case AW_Facebook_Subscribe_Helper_Data::VAR_COLORSCHEME:
                $value = $this->_getHelper()->getColorscheme();
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
            return self::SUBSCRIBE_BUTTON_TAG;
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

    public function getIframeParams()
    {
        $width = $this->getAttribute(AW_Facebook_Subscribe_Helper_Data::VAR_WIDTH);

        $params_array = array(
            'src'               => $this->getIframeSrc(),
            'scrolling'         => 'no',
            'frameborder'       => '0',
            'style'             => 'border:none; overflow:hidden;' . ($width ? ' width:' . $width . 'px;' : ''),
            'allowTransparency' => 'true',
            'height'            => '20px'
        );

        $params = array();
        foreach ($params_array as $param_key => $param_value) {
            $params[] = $param_key . '="' . $param_value . '"';
        }

        return implode(' ', $params);
    }

    public function getIframeSrc()
    {
        return Mage::helper('facebooksubscribe')->getFacebook()->getPluginsUrl().self::SUBSCRIBE_URL_SUFFIX.'?'. implode('&amp;', $this->_getParamsString());
    }

    public function getHTML5Params()
    {
        $params_array = array(
            'class'            => 'fb-subscribe',
            'data-colorscheme' => $this->getAttribute(AW_Facebook_Subscribe_Helper_Data::VAR_COLORSCHEME),
            'data-href'        => $this->getAttribute(AW_Facebook_Subscribe_Helper_Data::VAR_HREF),
            'data-layout'      => $this->getAttribute(AW_Facebook_Subscribe_Helper_Data::VAR_LAYOUT),
            'data-show-faces'  => $this->getAttribute(AW_Facebook_Subscribe_Helper_Data::VAR_SHOW_FACES),
            'data-width'       => $this->getAttribute(AW_Facebook_Subscribe_Helper_Data::VAR_WIDTH),
        );

        $params = array();
        foreach ($params_array as $param_key => $param_value) {
            $params[] = $param_key . '="' . $param_value . '"';
        }

        return implode(' ', $params);
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
            $value =  $this->getAttribute($var);
            if ($isFrame) {
                $vars[] = $var . '=' . $value;
            } else {

                $vars[] = $var . '="' . $value . '"';
            }
        }

        return $vars;
    }


    /**
     * @return AW_Facebook_Subscribe_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebooksubscribe');
    }


}
