<?php

class Redstage_Carousel_Model_Slide extends Mage_Core_Model_Abstract
{

    public function _construct()
    {
        parent::_construct();
        $this->_init('carousel/slide');
    }
}
