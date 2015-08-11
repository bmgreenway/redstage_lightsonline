<?php

class AW_Pinit_Helper_Data extends Mage_Core_Helper_Abstract
{
	const VAR_SHOW_IN_PRODUCT		= 'show_in_product';
	const VAR_SHOW_CUSTOM			= 'show_custom';
	const VAR_SHOW_WIDGET			= 'show_widget';

	const VAR_ENABLE_EXTENSION		= 'enable_extension';
	const VAR_PIN_COUNT				= 'pin_count';
	const BUTTON_PINIT_TEXT			= 'pinit_text';
	const IMAGE_WIDTH				= 'width';
	const USE_SHORT_DESCRIPTION		= 'short_description';
	const USE_PRICE					= 'use_price';
	const USE_CUSTOM				= 'use_custom';
	const TAB_CONTENT				= 'content';
	const TAB_GENERAL				= 'general';


    //general options
	public function isEnabled()
	{
		static $is_enabled = null;
		if (is_null($is_enabled)) {
			$is_enabled =Mage::getStoreConfig('pinit/general/enable_extension', Mage::app()->getStore()->getId());
		}
		return $is_enabled;
	}

    public function getWidth()
    {
        static $width = null;
		if (is_null($width)) {
            $width =Mage::getStoreConfig('pinit/general/width', Mage::app()->getStore()->getId());
        }
		return $width;
	}

    public function getUseDescription()
    {
        static $short_description = null;
        if (is_null($short_description)) {
            $short_description = Mage::getStoreConfig('pinit/general/short_description', Mage::app()->getStore()->getId());
        }
        return $short_description;
    }


	public function getUsePrice()
	{
        static $use_price = null;
        if (is_null($use_price)) {
            $use_price = Mage::getStoreConfig('pinit/general/use_price', Mage::app()->getStore()->getId());
        }
        return $use_price;
	}

	public function getUseCustom()
	{
        static $use_custom = null;
        if (is_null($use_custom)) {
            $use_custom = Mage::getStoreConfig('pinit/general/use_custom', Mage::app()->getStore()->getId());
        }
        return $use_custom;
	}

    public function getCount()
    {
        static $pin_count = null;
        if (is_null($pin_count)) {
            $pin_count = Mage::getStoreConfig('pinit/general/pin_count', Mage::app()->getStore()->getId());
        }
        return $pin_count;
    }

    //content options

    public function isShowOnProductPage()
    {
        return $this->isEnabled() && Mage::getStoreConfig('pinit/content/show_in_product', Mage::app()->getStore()->getId());
    }

    public function isShowCustom()
    {
        return $this->isEnabled() && Mage::getStoreConfig('pinit/content/show_custom', Mage::app()->getStore()->getId());
    }

    public function isShowWidget()
    {
        return $this->isEnabled() && Mage::getStoreConfig('pinit/content/show_widget', Mage::app()->getStore()->getId());
    }

    public function getPinitHtml()
    {
        $html = '';
        if (!Mage::registry('aw_pinit_html')) {
            $src = 'http'.(Mage::getModel('core/url')->getSecure() ? 's' : '').AW_Pinit_Block_Abstract::JAVASCRIPT_URL;
            $html = '
                <script type="text/javascript">
					(function(d){
						var script;
						first = d.getElementsByTagName("SCRIPT")[0];
						script = d.createElement("SCRIPT");
						script.type = "text/javascript";
						script.async = true;
						script.src = "'.$src.'";
						first.parentNode.insertBefore(script, first);
					}(document));
				</script>';

            Mage::register('aw_pinit_html', true);
        }

        return $html;
    }

}
