<?php

class AW_Facebook_Comments_Block_Catalog_Product_Comments extends AW_Facebook_Comments_Block_Abstract
{
    protected function _toHtml()
    {
        if (Mage::helper('facebookcomments')->isShowOnProductPage() &&  $facebook = Mage::helper('facebookcomments')->getFacebook()){
            return $facebook->getFacebookHtml().parent::_toHtml();
        }else {
            return '';
        }
    }


    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::helper('facebookcomments')->isShowOnProductPage() && !Mage::registry('aw_facebook_comments_insert_html_params') && $head = $this->getLayout()->getBlock('head'))
        {
            $head->setChild('catalog_product_facebookcommentsmeta', $this->getLayout()->createBlock('facebookcomments/catalog_product_commentsmeta'));
            Mage::register('aw_facebook_comments_insert_html_params', true);
        }
        return $this;
    }

}
