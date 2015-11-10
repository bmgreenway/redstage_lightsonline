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
 * Extends Varien_File_Uploader for limit upload size
 */
class AW_Extradownloads_Model_Uploader extends Varien_File_Uploader
{
    /**
     * Retrives upload limit in bites or Mbites
     * Retrives 0(zero) if no limits
     * @param boolean $mb Return in Mb
     * @return int
     */
    protected function _getSizeLimit($mb = false)
    {
        $limit = Mage::getStoreConfig('extradownloads/general/max_upload');
        if ($limit){
            if ($mb){
                return $limit;
            } else {
                return $limit * 1024 * 1024; # in bites
            }
        }
        return 0;
    }

    /**
     * Used to save uploaded file into destination folder with
     * original or new file name (if specified)
     *
     * @param string $destinationFolder
     * @param string $newFileName
     * @access public
     * @return void|bool
     */
    public function save($destinationFolder, $newFileName=null)
    {
        if (($limit = $this->_getSizeLimit()) && isset($this->_file['size'])){
            if ($this->_file['size'] > $limit){                
                $mb_lim = $this->_getSizeLimit(true);
                throw new Exception( Mage::helper('extradownloads')->__('Cant upload file larger than %s Mb', $mb_lim));
            }
        }
        return parent::save($destinationFolder, $newFileName);
    }
}
