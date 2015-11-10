<?php

class AW_Facebook_Comments_Block_Custom_Comments extends AW_Facebook_Comments_Block_Abstract
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if (Mage::helper('facebookcomments')->isShowCustom() && !Mage::registry('aw_facebook_comments_insert_html_params') && $head = $this->getLayout()->getBlock('head'))
        {
            $head->setChild('custom_facebookcommentsmeta', $this->getLayout()->createBlock('facebookcomments/custom_commentsmeta'));
            Mage::register('aw_facebook_comments_insert_html_params', true);
        }

        return $this;
    }

    protected function _toHtml()
    {
        if (Mage::helper('facebookcomments')->isShowCustom() && ($facebook = Mage::helper('facebookcomments')->getFacebook())
        ) {
            return $facebook->getFacebookHtml() . parent::_toHtml();
        } else {
            return '';
        }
    }
}
