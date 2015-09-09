<?php

class Redstage_Carousel_Block_Adminhtml_Carousel extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = "adminhtml_carousel";
        $this->_blockGroup = "carousel";
        $this->_headerText = "Carousel Slides";

        parent::__construct();
    }

    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock(
                $this->_blockGroup . '/' . $this->_controller . '_grid',
                $this->_controller . '.grid'
            )
            ->setSaveParametersInSession(true)
        );

        return parent::_prepareLayout();
    }
}
