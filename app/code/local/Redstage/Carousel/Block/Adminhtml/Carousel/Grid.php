<?php

class Redstage_Carousel_Block_Adminhtml_Carousel_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('slide_grid');
        $this->setDefaultSort('slide_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('carousel/slide')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header' => Mage::helper('carousel')->__('ID'),
                'index' => 'slide_id',
                'width' => '50px'
            )
        );

        $this->addColumn('name',
            array(
                'header' => Mage::helper('carousel')->__('Name'),
                'index' => 'name'
            )
        );

        $this->addColumn('link',
            array(
                'header' => Mage::helper('carousel')->__('Link URL'),
                'index' => 'link'
            )
        );

        $this->addColumn('sort_order',
            array(
                'header' => Mage::helper('carousel')->__('Sort Order'),
                'index' => 'sort_order',
                'width' => '100px'
            )
        );

        $this->addColumn('active',
            array(
                'header' => Mage::helper('carousel')->__('Active?'),
                'index' => 'active',
                'width' => '50px',
                'type' => 'options',
                'options' => array(
                    '0' => 'No',
                    '1' => 'Yes'
                )
            )
        );

        $this->addColumn('active',
            array(
                'header' => Mage::helper('carousel')->__('Store View'),
                'type' => 'store',
                'index' => 'store_id'
            )
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
