<?php

class AW_Facebook_Comments_Block_Widget_Comments
    extends AW_Facebook_Comments_Block_Abstract
    implements Mage_Widget_Block_Interface
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        if (Mage::helper('facebookcomments')->isShowWidget() && !Mage::registry('aw_facebook_comments_insert_html_params') && $head = $this->getLayout()->getBlock('head'))
        {
            $head->setChild('widget_facebookcomments', $this->getLayout()->createBlock('facebookcomments/widget_commentsmeta'));
            Mage::register('aw_facebook_comments_insert_html_params', true);
        }
        return $this;
    }

    protected function _toHtml()
    {
        if (Mage::helper('facebookcomments')->isShowWidget() && $facebook = Mage::helper('facebookcomments')->getFacebook()){
            return $facebook->getFacebookHtml() . parent::_toHtml();
        } else {
            return '';
        }
    }
}