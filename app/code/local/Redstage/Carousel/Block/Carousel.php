<?php

class Redstage_Carousel_Block_Carousel extends Mage_Core_Block_Template
{

    /**
     * Slides associated with this carousel.
     */
    protected $_slides;

    public function _construct()
    {
        parent::_construct();

        $activeSlides = Mage::getModel('carousel/slide')
            ->getCollection()
            ->addFieldToFilter('active', '1')
            ->addFieldToFilter('store_id', Mage::app()->getStore()->getStoreId())
            ->setOrder('sort_order');

        $this->setSlides($activeSlides);
    }

    public function getSlides()
    {
        return $this->_slides;
    }

    public function setSlides($slides)
    {
        $this->_slides = $slides;
        return $this;
    }
}
