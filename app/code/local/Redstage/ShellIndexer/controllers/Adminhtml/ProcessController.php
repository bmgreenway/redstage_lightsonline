<?php
require_once 'Mage/Index/controllers/Adminhtml/ProcessController.php';
class Redstage_ShellIndexer_Adminhtml_ProcessController extends Mage_Index_Adminhtml_ProcessController {
    public function shellAction() {
        $process = Mage::getSingleton('index/indexer');
        $collection=$process->getProcessesCollection();

        foreach ($collection as $process) { $processes[] = $process; }

        foreach ($collection as $process) {
            /* @var $process Mage_Index_Model_Process */
            try {
                $process->reindexEverything();
            } catch (Mage_Core_Exception $e) {
                Mage::logException($e);
            } catch (Exception $e) {
                Mage::logException($e);
            }
        }
        Mage::app()->getCacheInstance()->flush();
    } 
}
