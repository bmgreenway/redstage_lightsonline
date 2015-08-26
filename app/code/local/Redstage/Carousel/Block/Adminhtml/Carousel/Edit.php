<?php

class Redstage_Carousel_Block_Adminhtml_Carousel_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'carousel';
        $this->_controller = 'adminhtml_carousel';
        $this->_mode = 'edit';

        $this->_addButton('save_and_continue', array(
            'label' => Mage::helper('carousel')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save'
        ), -100);
        $this->_updateButton('save', 'label', Mage::helper('carousel')->__('Save Slide'));
        $this->_updateButton('delete', 'label', Mage::helper('carousel')->__('Delete Slide'));

        $this->_formScripts[] = <<<EOF
function saveAndContinueEdit(){
    editForm.submit($('edit_form').action+'back/edit/');
}
EOF;
    }

    protected function _prepareLayout()
    {
        if ($this->_blockGroup && $this->_controller && $this->_mode) {
            $this->setChild('form', $this->getLayout()->createBlock(
                $this->_blockGroup . '/' . $this->_controller . '_' . $this->_mode . '_form'
            ));
        }

        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }

        return parent::_prepareLayout();
    }

    public function getHeaderText()
    {
        if (Mage::registry('slide_data') && Mage::registry('slide_data')->getId())
        {
            return Mage::helper('carousel')->__('Edit Slide "%s"', $this->htmlEscape(Mage::registry('slide_data')->getName()));
        } else {
            return Mage::helper('carousel')->__('New Slide');
        }
    }
}
