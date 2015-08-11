<?php

class AW_Google_Share_Block_Abstract extends Mage_Core_Block_Template
{
    const URL               = 'plusone.js';
    const DEFAULT_HTML_TAG	= 'div';
    const HTML_PARAM_PREFIX = 'data-';
    const CLASS_NAME        = 'g-plus';
    const TAG_NAME          = 'g:plus';
    const PARAM_CLASS       = 'class';

    protected $_config_vars_values = array();
    protected $_config_vars = array();
    protected $_isHtml = null;

	public function getAttribute($name)
	{
		if (array_key_exists($name, $this->_config_vars_values)) {
			return $this->_config_vars_values[$name];
		} else {
            $value = null;
            switch ($name){
                case AW_Google_Share_Helper_Data::PARAM_ANNOTATION:
                    $value = $this->_getHelper()->getAnnotation();
                    break;

                case AW_Google_Share_Helper_Data::PARAM_HEIGHT:
                    $value = $this->_getHelper()->getHeight();
                    break;

                case AW_Google_Share_Helper_Data::PARAM_WIDTH:
                    $value = $this->_getHelper()->getWidth();
                    break;
            }
            return $value;
		}
	}

	public function isHtml()
	{
		if (is_null($this->_isHtml)) {
			$this->_isHtml = ($this->_getHelper()->getButtonCode() == '1');
		}

		return $this->_isHtml;
	}

	public function getTag()
	{
		if ($this->isHtml()) {
			return self::DEFAULT_HTML_TAG;
		} else {
			return self::TAG_NAME;
		}
	}

	public function getTagParams()
	{
		if ($this->isHtml()) {
			return $this->getHtmlParams();
		} else {
			return $this->getGoogleParams();
		}
	}

	public function getHtmlParams()
	{
		$this->addConfigVar(self::PARAM_CLASS, self::CLASS_NAME, false);

		return $this->_getParamsString();
	}

	public function getGoogleParams()
	{
		return $this->_getParamsString();
	}

	public function getConfigVars()
	{
		return $this->_config_vars;
	}

	public function resetConfigVars($ignore = array())
	{
		if (empty($ignore)) {
			$this->_config_vars = array();
			$this->_config_vars_values = array();
		} else {
			$temp_config_vars_values = array();
			foreach ($ignore as $key) {
				if (array_key_exists($key, $this->_config_vars_values)) {
					$temp_config_vars_values[$key] = $this->_config_vars_values[$key];
				}
			}
			$this->_config_vars = $ignore;
			$this->_config_vars_values = $temp_config_vars_values;
		}
	}

	public function addConfigVar($var, $value = '', $toEnd = true)
	{
		if ($toEnd) {
			array_push($this->_config_vars, $var);
		} else {
			array_unshift($this->_config_vars, $var);
		}

		$this->_config_vars_values[$var] = $value;
	}

	protected function _getParamsString($url = false)
	{
		$this->prepareConfigVars();
		$vars = array();
		$config_vars = $this->getConfigVars();

		foreach ($config_vars as $var) {
			$name = $this->_getButtonParamName($var, $url);
			$value = $this->_getButtonParamValue($var, $url);

			if (!$name || !$value) {
				continue;
			}
			if ($url) {
				$vars[] = $name . '=' . $value;
			} else {
				$vars[] = $name . '="' . $value . '"';
			}
		}

		return implode(($url ? '&' : ' '), $vars);
	}

	protected function _getButtonParamName($name, $url = false)
	{
		if ($this->isHtml()) {
			if (!in_array($name, array('class', 'expandTo'))) {
				$name = self::HTML_PARAM_PREFIX . $name;
			}
		}

		return $name;
	}

	protected function _getButtonParamValue($var, $url = false)
	{
		switch ($var) {
			default:
				$value = $this->getAttribute($var);
		}

		if ($url) {
			$value = rawurlencode($value);
		}

		return $value;
	}

	public function prepareConfigVars()
	{
		$annotation = $this->getAttribute(AW_Google_Share_Helper_Data::PARAM_ANNOTATION);

		if ($annotation == 'vertical-bubble') {
			$this->addConfigVar(AW_Google_Share_Helper_Data::PARAM_ANNOTATION, $annotation);
		} else {
            if(!in_array(AW_Google_Share_Helper_Data::PARAM_ANNOTATION,$this->_config_vars)){
                array_push($this->_config_vars, AW_Google_Share_Helper_Data::PARAM_ANNOTATION);
            }
            if(!in_array(AW_Google_Share_Helper_Data::PARAM_HEIGHT,$this->_config_vars)){
                array_push($this->_config_vars, AW_Google_Share_Helper_Data::PARAM_HEIGHT);
            }
		}
		if ($annotation == 'inline'){
            if(!in_array(AW_Google_Share_Helper_Data::PARAM_WIDTH,$this->_config_vars)){
                array_push($this->_config_vars, AW_Google_Share_Helper_Data::PARAM_WIDTH);
            }
        }

		$this->addConfigVar(AW_Google_Share_Helper_Data::PARAM_ACTION, AW_Google_Share_Helper_Data::ACTION_SHARE);
	}


    /**
     * @return AW_Google_Share_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('googleshare');
    }

}
