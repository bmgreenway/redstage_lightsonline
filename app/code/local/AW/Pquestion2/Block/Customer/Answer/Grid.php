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
 * @package    AW_Pquestion2
 * @version    2.1.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class AW_Pquestion2_Block_Customer_Answer_Grid extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->_prepareCollection();
    }

    protected function _prepareCollection()
    {
        $currentCustomer = Mage::getSingleton('customer/session')->getCustomer();
        /** @var AW_Pquestion2_Model_Resource_Answer_Collection $collection */
        $collection = Mage::getModel('aw_pq2/answer')->getCollection();
        $collection->addFilterByCustomer($currentCustomer);
        $this->setCollection($collection);
        return $this;
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $pager = $this->getLayout()->createBlock('page/html_pager', 'sales.order.history.pager')
            ->setCollection($this->getCollection())
        ;
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

    /**
     * @param AW_Pquestion2_Model_Answer $answer
     *
     * @return string
     */
    public function getProductUrlByAnswer(AW_Pquestion2_Model_Answer $answer)
    {
        /** @var Mage_Catalog_Model_Product $product */
        $product = $answer->getQuestion()->getProduct();
        if (null === $product->getId()) {
            return '';
        }
        return $product->getProductUrl();
    }

    /**
     * @param AW_Pquestion2_Model_Answer $answer
     *
     * @return string
     */
    public function getProductNameByAnswer(AW_Pquestion2_Model_Answer $answer)
    {
        /** @var Mage_Catalog_Model_Product $product */
        $product = $answer->getQuestion()->getProduct();
        if (null === $product->getId()) {
            return '';
        }
        return $product->getName();
    }

    /**
     * @param AW_Pquestion2_Model_Answer $answer
     *
     * @return string
     */
    public function getStatusLabelByAnswer(AW_Pquestion2_Model_Answer $answer)
    {
        return Mage::getModel('aw_pq2/source_question_status')->getOptionByValue($answer->getStatus());
    }
}