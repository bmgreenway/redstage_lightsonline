<?php

class AW_Twitter_Tweet_Block_Abstract extends Mage_Core_Block_Template
{
	const URL						= 'tweet_button.html';
	const HREF_SUFFIX				= 'share';
	const JAVASCRIPT_PARAM_PREFIX	= 'data-';
	const CLASS_NAME				= 'twitter-share-button';
	const PARAM_CLASS				= 'class';
	const PARAM_HREF				= 'href';
	const PARAM_ALLOWTRANSPARENCY	= 'allowtransparency';
	const PARAM_FRAMEBORDER			= 'frameborder';
	const PARAM_SCROLLING			= 'scrolling';
	const PARAM_SRC					= 'src';
	const PARAM_STYLE				= 'style';

	protected $_isIframe			= null;
	protected $_config_vars_values	= array();
	protected $_config_vars			= array(
		'url',
		'via',
		'text',
		'related',
		'count',
		'lang',
		'counturl',
	);


	public function getAttribute($name)
	{
		if(array_key_exists($name, $this->_config_vars_values)) {
			return $this->_config_vars_values[$name];
		} else {
            $value = null;
            switch ($name){
                case 'url':
                    $value = Mage::helper('core/url')->getCurrentUrl();
                    break;
                case 'via':
                    $value = $this->_getHelper()->getVia();
                    break;
                case 'text':
                    $value = $this->_getHelper()->getDefaultText();
                    break;
                case 'related':
                    $value = $this->_getHelper()->getRelated();
                    break;
                case 'count':
                    $value = $this->_getHelper()->getCount();
                    break;
                case 'counturl':
                    $value = $this->_getHelper()->getCounturl();
                    break;
            }
            return $value;
		}
	}


	public function isIframe()
	{
		if(is_null($this->_isIframe)) {
			$this->_isIframe = ($this->_getHelper()->getButtonCode() == 'iframe');
		}
		return $this->_isIframe;
	}

	public function getTag()
	{
		if($this->isIframe()) {
			return 'iframe';
		} else {
			return 'a';
		}
	}

	public function getTagParams()
	{
		if($this->isIframe()) {
			return $this->getIframeParams();
		} else {
			return $this->getJavascriptParams();
		}
	}

	public function getTagText()
	{
		if($this->isIframe()) {
			return '';
		} else {
			return Mage::helper('twittertweet')->__('Tweet');
		}
	}

	public function getIframeParams()
	{
		$src = $this->getIframeSrc();

		$this->resetConfigVars();

		$this->addConfigVar(self::PARAM_ALLOWTRANSPARENCY, true);
		$this->addConfigVar(self::PARAM_FRAMEBORDER, 0);
		$this->addConfigVar(self::PARAM_SCROLLING, 'no');
		$this->addConfigVar(self::PARAM_SRC, $src);
		$width = $this->_getHelper()->getWidth();
		$height = $this->_getHelper()->getHeight();
		$this->addConfigVar(self::PARAM_STYLE, 'border:none; overflow:hidden;'.($width ? ' width:'.$width .';' : '').($height ? ' height:'.$height .';' : ''));

		return $this->_getParamsString();
	}

	public function getIframeSrc()
	{
		return AW_Twitter_Tweet_Helper_Data::IFRAME_URL.self::URL . '?'.$this->_getParamsString(true);
	}

	public function getLinkHref()
	{
		return AW_Twitter_Tweet_Helper_Data::TWITTER_URL. self::HREF_SUFFIX;
	}

	public function getJavascriptParams()
	{
		$this->addConfigVar(self::PARAM_CLASS, self::CLASS_NAME);
		$this->addConfigVar(self::PARAM_HREF, $this->getLinkHref());

		return $this->_getParamsString();
	}

	public function getConfigVars()
	{
		return $this->_config_vars;
	}

	public function resetConfigVars($ignore = array())
	{
		if(empty($ignore)) {
			$this->_config_vars			= array();
			$this->_config_vars_values	= array();
		} else {
			$temp_config_vars_values	= array();
			foreach($ignore as $key) {
				if(array_key_exists($key, $this->_config_vars_values)) {
					$temp_config_vars_values[$key] = $this->_config_vars_values[$key];
				}
			}

			$this->_config_vars			= $ignore;
			$this->_config_vars_values	= $temp_config_vars_values;
		}
	}

	public function addConfigVar($var, $value='', $toEnd=true)
	{
		if($toEnd) {
			array_push($this->_config_vars, $var);
		} else {
			array_unshift($this->_config_vars, $var);
		}

		$this->_config_vars_values[$var] = $value;
	}

	protected function _getParamsString($url=false)
	{
		$vars = array();
		$config_vars = $this->getConfigVars();
		foreach($config_vars as $var) {
			$name	= $this->_getButtonParamName($var, $url);
			$value	= $this->_getButtonParamValue($var, $url);
			if(!$name || !$value) {
				continue;
			}
			if($url) {
				$vars[] = $name.'='.$value;
			} else {
				$vars[] = $name.'="'.$value.'"';
			}
		}

		return implode(($url ? '&' : ' '), $vars);
	}

	protected function _getButtonParamName($name, $url=false)
	{
		if(!$this->isIframe()) {
			if(!in_array($name, array('class','href'))) {
				$name = self::JAVASCRIPT_PARAM_PREFIX.str_replace('_', '-', $name);
			}
		}

		return $name;
	}

	protected function _getButtonParamValue($var, $url=false)
	{
		switch($var) {
			case 'lang':
				$value = Mage::app()->getLocale()->getLocale()->getLanguage();
				$value = $value ? $value : 'en';
			break;

			default:
				$value = $this->getAttribute($var);
		}

		if($url) {
			$value = rawurlencode($value);
		}

		return $value;
	}

    /**
     * @return AW_Twitter_Tweet_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('twitterfollow');
    }
}
