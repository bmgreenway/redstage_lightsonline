<?php
class Redstage_LandingPage_Block_LandingPage extends Mage_Core_Block_Template
{
	public function _construct()
	{
		$this->setTemplate('redstage_landingpage/category.phtml');
	}

	public function getSubCategories()
	{
		$parentCategoryId = $this->getCatId();
		if ($parentCategoryId) {
			$categories = Mage::getModel('catalog/category')
			    ->getCollection()
			    ->addFieldToFilter('parent_id', array('eq'=>$parentCategoryId))
			    ->addFieldToFilter('is_active', array('eq'=>'1'))
			    ->addAttributeToSelect('*');   
		    return $categories;
		}
	}
}