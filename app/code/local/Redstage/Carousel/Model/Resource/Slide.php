<?php

class Redstage_Carousel_Model_Resource_Slide extends Mage_Core_Model_Resource_Db_Abstract
{

    public function _construct()
    {
        $this->_init('carousel/slide', 'slide_id');
    }
}
