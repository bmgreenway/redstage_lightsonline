<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento enterprise edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Extradownloads
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


/**
 * Implements product edit Extra Downloads tab
 */
class AW_Extradownloads_Block_Adminhtml_Catalog_Product_Edit_Tab_Extradownloads
    extends Mage_Adminhtml_Block_Widget implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Extra Downloads product edit tab template
     */
    const EXTRADOWNLOADS_TEMPLATE = "extradownloads/product/edit/tab.phtml";

    /**
     * Cached current product
     * @var Mage_Catalog_Model_Product
     */
    protected $_product = null;

    /**
     * This is constructor
     * It set template
     */
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate(self::EXTRADOWNLOADS_TEMPLATE);
    }

    /**
     * Returns tab label
     * @return String
     */
    public function getTabLabel()
    {
        return Mage::helper('extradownloads')->__('Extra Downloads');
    }

    /**
     * Returns tab title
     * @return String
     */
    public function getTabTitle()
    {
        return Mage::helper('extradownloads')->__('Extra Downloads');
    }

    /**
     * Check if tab can be displayed
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Check if tab is hidden
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Returns Model of current product
     * @return Mage_Catalog_Model_Product
     */
    public function getProduct()
    {
        if (!$this->_product){
            $this->_product = Mage::registry('current_product');
        }                
        return $this->_product;
    }

    /**
     * Render block HTML
     * @return String
     */
    protected function _toHtml()
    {
        $accordion = $this->getLayout()->createBlock('adminhtml/widget_accordion')
            ->setId('extradownloadsInfo');

        $accordion->addItem('general', array(
            'title'   => Mage::helper('extradownloads')->__('General'),
            'content' => $this->getLayout()->createBlock('extradownloads/adminhtml_catalog_product_edit_tab_extradownloads_general')->toHtml(),
            'open'    => false,
        ));

        $accordion->addItem('statistics', array(
            'title'   => Mage::helper('extradownloads')->__('Statistics'),
            'content' => '<div id="extradownloads_statistics" class="fieldset">'.$this->getLayout()->createBlock('extradownloads/adminhtml_catalog_product_edit_tab_extradownloads_statistics')->toHtml().'</div>',
            'open'    => false,
        ));

        $this->setChild('accordion', $accordion);
        
        return parent::_toHtml();
    }
}

