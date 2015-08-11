<?php

class AW_Facebook_Comments_Block_Abstract extends Mage_Core_Block_Template
{
    const COMMENTS_BUTTON_TAG = 'fb:comments';
    const COMMENTS_URL_SUFFIX = 'comments.php';
    const META_PREFIX_FB      = 'fb:';

    protected $_isHTML5 = null;

    static protected $METAS = array(
        AW_Facebook_Core_Helper_Data::VAR_ADMINS,
        AW_Facebook_Core_Helper_Data::VAR_APP_ID
    );

    static protected $CONFIG_VARS	= array(
        AW_Facebook_Core_Helper_Data::VAR_LOCAL,
        AW_Facebook_Comments_Helper_Data::VAR_HREF,
        AW_Facebook_Comments_Helper_Data::VAR_NUM_POSTS,
        AW_Facebook_Comments_Helper_Data::VAR_WIDTH,
        AW_Facebook_Comments_Helper_Data::VAR_COLORSCHEME,
    );

    public function getAttribute($name)
    {
        $value = null;

        switch ($name){
            case AW_Facebook_Core_Helper_Data::VAR_LOCAL:
                $value = $this->_getHelper()->getLocaleCode();
                break;
            case AW_Facebook_Comments_Helper_Data::VAR_HREF:
                $value = $this->_getHelper()->getCommentUrl();
                break;
            case AW_Facebook_Comments_Helper_Data::VAR_NUM_POSTS:
                $value = $this->_getHelper()->getNumberPosts();
                break;
            case AW_Facebook_Comments_Helper_Data::VAR_WIDTH:
                $value = $this->_getHelper()->getWidth();
                break;
            case AW_Facebook_Comments_Helper_Data::VAR_COLORSCHEME:
                $value = $this->_getHelper()->getColorscheme();
                break;
        }

        return $value;
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
        if ($this->isHTML5()) {
            return 'div';
        } else {
            return self::COMMENTS_BUTTON_TAG;
        }
    }

    public function getTagParams()
    {
        if ($this->isHTML5()) {
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
                $value    = $this->_getButtonParamValue($var, $this->getAttribute($var));
                $params[] = 'data-' . str_replace("_", "-", $var) . '="' . $value . '"';
            }
        }
        array_unshift($params, 'class="fb-comments"');
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
            $value = $this->_getButtonParamValue($var, $this->getAttribute($var));
            if ($isFrame) {
                $vars[] = $var . '=' . $value;
            } else {
                $vars[] = $var . '="' . $value . '"';
            }
        }

        return $vars;
    }

    protected function _getButtonParamValue($var, $value)
    {
        return $value;
    }

    protected function _getMetaTagsContent($property)
    {
        switch ($property){
            case AW_Facebook_Core_Helper_Data::VAR_ADMINS:
                return $this->_getHelper()->getAdmins();
                break;

            case AW_Facebook_Core_Helper_Data::VAR_APP_ID:
                return Mage::helper('facebookcore')->getAppID();
                break;
        }
    }

    public function getMetaTagsParams()
    {
        $params = array();
        foreach (self::$METAS as $meta) {
            if ($this->_getHelper()->checkMetaTag($meta)) {
                continue;
            }
            $content = $this->_getMetaTagsContent($meta, $this->getAttribute($meta));
            $params[self::META_PREFIX_FB . $meta] = $content;

            $this->_getHelper()->addMetaTag($meta);
        }
        return $params;
    }


    /**
     * @return AW_Facebook_Comments_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookcomments');
    }
}
