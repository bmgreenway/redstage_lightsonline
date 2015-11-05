<?php

class Redstage_Carousel_Block_Adminhtml_Carousel_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    protected function _prepareForm()
    {
        if (Mage::getSingleton('adminhtml/session')->getSlideData())
        {
            $data = Mage::getSingleton('adminhtml/session')->getSlideData();
            Mage::getSingleton('adminhtml/session')->getSlideData(null);
        } elseif (Mage::registry('slide_data')) {
            $data = Mage::registry('slide_data')->getData();
        } else {
            $data = array();
        }

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl(
                '*/*/save',
                array('id' => $this->getRequest()->getParam('id'))
            ),
            'method' => 'post',
            'enctype' => 'multipart/form-data'
        ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('slide_form', array(
            'legend' => Mage::helper('carousel')->__('Slide Information')
        ));

        $fieldset->addField('active', 'select', array(
            'options' => array(
                0 => 'No',
                1 => 'Yes'
            ),
            'label' => Mage::helper('carousel')->__('Active?'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'active',
            'note' => Mage::helper('carousel')->__('Add slide to carousel?')
        ));

        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('carousel')->__('Sort Order'),
            'value' => '0',
            'class' => 'required-entry validate-number',
            'required' => true,
            'name' => 'sort_order',
            'note' => Mage::helper('carousel')->__('Order of the slide in the collection (larger numbers push the slide to the right).')
        ));
        $fieldset->addField('caption', 'editor', array(
            'label' => Mage::helper('carousel')->__('Caption'),
            'value' => '0',
            'class' => 'required-entry',
            'wysiwyg'   => true,
            'required' => false,
            'style'     => 'height:15em',
            'name' => 'caption',
            'note' => Mage::helper('carousel')->__('To show promo code on banner')
        ));
        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('carousel')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'name',
            'note' => Mage::helper('carousel')->__('Internal name of the slide.')
        ));

        $fieldset->addField('image', 'image', array(
            'label' => Mage::helper('carousel')->__('Image'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'image',
            'note' => Mage::helper('carousel')->__('Main image for the slide (will also be resized for the thumbnail)')
        ));

        $fieldset->addField('link', 'text', array(
            'label' => Mage::helper('carousel')->__('Link'),
            'class' => 'required-entry validate-url',
            'required' => true,
            'name' => 'link',
            'note' => Mage::helper('carousel')->__('URL for the link button.')
        ));

        $fieldset->addField('store_id', 'select', array(
            'label'     => Mage::helper('carousel')->__('Visible In'),
            'required'  => true,
            'name'      => 'store_id',
            'values'    => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm()
        ));          

        $form->setValues($data);

        return parent::_prepareForm();
    }
}
