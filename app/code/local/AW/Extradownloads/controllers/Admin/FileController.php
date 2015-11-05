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
 * Backend File controller
 */
class AW_Extradownloads_Admin_FileController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Upload file controller action
     */
    public function uploadAction()
    {
        $tmpPath = AW_Extradownloads_Model_File::getBaseTmpPath();
        $result = array();
        try {
            $uploader = new AW_Extradownloads_Model_Uploader('extradownloads');
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $result = $uploader->save($tmpPath);
            $result['cookie'] = array(
                'name'     => session_name(),
                'value'    => $this->_getSession()->getSessionId(),
                'lifetime' => $this->_getSession()->getCookieLifetime(),
                'path'     => $this->_getSession()->getCookiePath(),
                'domain'   => $this->_getSession()->getCookieDomain()
            );
        } catch (Exception $e) {
            $result = array('error'=>$e->getMessage(), 'errorcode'=>$e->getCode());
        }
        $this->getResponse()->setBody(Zend_Json::encode($result));
    }

    /**
     * Reset statistics for Product [and Store]
     */
    public function resetAction()
    {
        # Get target data
        $product_id  = $this->getRequest()->getParam('product_id');
        $store_id  = $this->getRequest()->getParam('store_id');

        # Reset collection
        if ($collection = Mage::getModel('extradownloads/file')->getCollection()){
            $collection->addAttributeToFilter('product_id', $product_id);
            if ($store_id){
                $collection->setStore($store_id);
            }
            foreach ($collection as $file){
                $file->resetProductStatistics($store_id);
            }
        }

        # Prepare content to return
        $out = '';
        $out = $this->getLayout()
                ->createBlock('extradownloads/adminhtml_catalog_product_edit_tab_extradownloads_statistics')
                ->setProductId($product_id)
                ->setStoreId($store_id)
                ->toHtml();
        $this->getResponse()->setBody($out);
        return;
    }

    /**
     * Reset all statistics
     */
    public function resetAllAction()
    {
        try{
            Mage::getModel('extradownloads/file')->resetAllStatistics();
        } catch (Exception $e){
            Mage::throwException($e->getMessage());
        }        
        return ;
    }

    /**
     * Check admin permissions for this controller
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('catalog/products');
    }
}