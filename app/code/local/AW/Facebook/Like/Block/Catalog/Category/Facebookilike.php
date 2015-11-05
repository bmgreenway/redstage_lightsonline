<?php

class AW_Facebook_Like_Block_Catalog_Category_Facebookilike extends AW_Facebook_Like_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('facebookilike')->isShowInCategoryPage() &&  $facebook = Mage::helper('facebookilike')->getFacebook()){
            return $facebook->getFacebookHtml().parent::_toHtml();
        }else {
            return '';
        }
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (!Mage::registry('aw_facebookilikemeta_inserted') && $head = $this->getLayout()->getBlock('head'))
        {
            $head->setChild('catalog_category_facebookilikemeta', $this->getLayout()->createBlock('facebookilike/catalog_category_facebookilikemeta'));
            Mage::register('aw_facebookilikemeta_inserted', true);
        }

        return $this;
    }
}
