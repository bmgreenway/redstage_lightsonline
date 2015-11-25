<?php
require_once('app/Mage.php');
umask(0);
Mage::app('admin');
set_time_limit(0);
ini_set('max_execution_time', 0);

$products = Mage::getModel('catalog/product')
    ->getCollection()
    ->addAttributeToSelect(array('name', 'sku', 'updated_at'));

//$products->getSelect()->where('created_at = updated_at');
$products->getSelect()->where("updated_at <  date_sub(now(), interval 3 hour)");

$i = 1;
$total = $products->count();

foreach ($products as $product) {
    print $i . "/" . $total . " Saving " . $product->getName() . "... <br />\n";
    Mage::log($i++ . " Saving " . $product->getName(), null, "magmi_resaveall.log");
    $product->load();
    $product->setData('updated_at', date("Y-m-d H:i:s"));
    try {
        $product->save();
    } catch (Exception $e) {

    }
}

Mage::log("Reindexing...", null, "magmi_resaveall.log");

$indexingProcesses = Mage::getSingleton('index/indexer')->getProcessesCollection();

foreach ($indexingProcesses as $process) {
    $process->reindexEverything();
}

echo "<h1>DONE</h1>"; 
exit;
