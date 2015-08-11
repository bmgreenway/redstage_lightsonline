<?php

class AW_Google_Plusone_Helper_Data extends Mage_Core_Helper_Abstract
{
    const PARAM_SIZE         = 'size';
    const PARAM_COUNT        = 'count';
    const LANGUAGE           = 'language';
    const VAR_HREF           = 'href';
    const GOOGLE_APIS_JS_URL = 'https://apis.google.com/js/';

    protected $_defaultCode = 'en_US';

    protected $_googleLocaleCode = array(
        'af_ZA', 'az_AZ', 'id_ID', 'ms_MY', 'bs_BA', 'ca_ES', 'cs_CZ',
        'cy_GB', 'da_DK', 'de_DE', 'et_EE', 'en_PI', 'en_GB', 'en_UD',
        'en_US', 'es_LA', 'es_ES', 'eo_EO', 'eu_ES', 'tl_PH', 'fo_FO',
        'fr_CA', 'fr_FR', 'fy_NL', 'ga_IE', 'gl_ES', 'ko_KR', 'hr_HR',
        'is_IS', 'it_IT', 'ka_GE', 'sw_KE', 'ku_TR', 'lv_LV', 'fb_LT',
        'lt_LT', 'la_VA', 'hu_HU', 'nl_NL', 'ja_JP', 'nb_NO', 'nn_NO',
        'pl_PL', 'pt_BR', 'pt_PT', 'ro_RO', 'ru_RU', 'sq_AL', 'sk_SK',
        'sl_SI', 'fi_FI', 'sv_SE', 'th_TH', 'vi_VN', 'tr_TR', 'zh_CN',
        'zh_TW', 'zh_HK', 'el_GR', 'bg_BG', 'mk_MK', 'sr_RS', 'uk_UA',
        'hy_AM', 'he_IL', 'ar_AR', 'ps_AF', 'fa_IR', 'ne_NP', 'hi_IN',
        'bn_IN', 'pa_IN', 'ta_IN', 'te_IN', 'ml_IN',
    );



    //general settings

    public function getButtonCode()
    {
        return Mage::getStoreConfig('googleplusone/general/button_code', Mage::app()->getStore()->getId());
    }

    public function getUrlOfPage()
    {
        return Mage::getStoreConfig('googleplusone/general/href', Mage::app()->getStore()->getId());
    }

    public function isDisplayCountBox()
    {
        return Mage::getStoreConfig('googleplusone/general/count', Mage::app()->getStore()->getId());
    }

    public function getButtonSize()
    {
        return Mage::getStoreConfig('googleplusone/general/size', Mage::app()->getStore()->getId());
    }


    //content settings

    public function isShowInCms()
    {
        return Mage::getStoreConfig('googleplusone/content/show_in_cms', Mage::app()->getStore()->getId());
    }

    public function isShowInHome()
    {
        return Mage::getStoreConfig('googleplusone/content/show_in_home', Mage::app()->getStore()->getId());
    }

    public function isShowOnProductPage()
    {
        return Mage::getStoreConfig('googleplusone/content/show_in_product', Mage::app()->getStore()->getId());
    }

    public function isShowInCategoryPage()
    {
        return Mage::getStoreConfig('googleplusone/content/show_in_category', Mage::app()->getStore()->getId());
    }

    public function isShowCustom()
    {
        return Mage::getStoreConfig('googleplusone/content/show_custom', Mage::app()->getStore()->getId());
    }

    public function isShowWidget()
    {
        return Mage::getStoreConfig('googleplusone/content/show_widget', Mage::app()->getStore()->getId());
    }

    public function getLocaleCode()
    {
        $localCode = Mage::app()->getLocale()->getLocaleCode();
        $localCode = in_array($localCode, $this->_googleLocaleCode) ? $localCode : $this->_defaultCode;
        return $localCode;
    }


    public  function getGoogleJsHtml()
    {
        $html = '';
        if (!Mage::registry('aw_google_html')) {
            $src = self::GOOGLE_APIS_JS_URL . AW_Google_Plusone_Block_Abstract::URL;
            $lang = Mage::helper('googleplusone')->getLocaleCode();
            $html =
                '<script type="text/javascript">
                    window.___gcfg = {lang: "' . $lang . '"};
                    (function() {
                            var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
                            po.src = "' . $src . '";
                            var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
                    })();
                </script>';
            Mage::register('aw_google_html', true);
        }

        return $html;
    }
}
