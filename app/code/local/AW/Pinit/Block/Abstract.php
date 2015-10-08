<?php

class AW_Pinit_Block_Abstract extends Mage_Core_Block_Template
{

	const BUTTON_PINIT_CLASS	= 'pin-it-button';
	const PINIT_URl				= '://pinterest.com/pin/create/button/?';
	const JAVASCRIPT_URL		= '://assets.pinterest.com/js/pinit.js';

	public function getHref()
	{
		$_product = Mage::registry('current_product');
		$url = $this->getCurrentUrl();
		$media = $this->getMediaImage($_product);
		$description = $this->getDescriptionProduct($_product);
		$piniturl = 'http' . (Mage::app()->getStore()->isCurrentlySecure() ? 's' : '') . self::PINIT_URl . $url . $media . $description;

		return $piniturl;
	}

	public function getClass()
	{
		return self::BUTTON_PINIT_CLASS;
	}

	public function getCount()
	{
		return Mage::helper('pinit')->getCount();
	}

	public function getCurrentUrl()
	{
		return 'url=' . $this->helper('core/url')->getCurrentUrl();
	}

	public function getMediaImage($product)
	{
		$width = Mage::helper('pinit')->getWidth();
		return '&media=' . $this->helper('catalog/image')->init($product, 'image')->resize($width);
	}

	
	public function getDescriptionProduct($product)
	{
		$price = null;
		if ($product->getTypeId() == 'simple'){
			$price = $product->getPrice();
		}
		$formattedPrice = $price?Mage::helper('core')->currency($price, true, false).".":'';
		$description = '';
		$use_description = Mage::helper('pinit')->getUseDescription();
		$use_price = Mage::helper('pinit')->getUsePrice();
		$use_custom = Mage::helper('pinit')->getUseCustom();
		if ($use_price)
			$description = '&description='.$formattedPrice;
		if ($use_price && $use_description) {
			$description = $description.$product->getShortDescription();
		}
		if (!$use_price && $use_description) {
			$description = '&description=' . $product->getShortDescription();
		}
				
 		if($use_custom){
			
			$description = '&description='.$this ->getCustomDescription($product,$use_custom);
		}
		
		return $description;
	}
	
	public function getCustomDescription($product,$string)
	{
		
		$match = explode('"',$string);
		$count = count($match);
		if ( $count > 1){
			for($i = 1;$i < $count;$i = $i+2)
			{
				$attr = $product->getResource()->getAttribute($match[$i])->getFrontend()->getValue($product);
				if ($match[$i] == 'price'){
					$attr = Mage::helper('core')->currency($attr, true, false);
				}
				if ($attr){
					$string = str_replace ("\"".$match[$i]."\"",$attr,$string);
				}
			}
		}
		
		return htmlspecialchars($string);
		
	}
	

}