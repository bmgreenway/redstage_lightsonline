<?php
$installer = $this;

$installer->startSetup();

$blocks = array(		
    array(
			'identifier' => 'fan_group_a',
			'title' => 'Fan Group A Content',
			'content' => 'Compare: 49" to 60" ceiling fans have airflow efficiencies ranging from approximately 51 to 176 cubic feet per minute per watt at high speed.'
		),
    array(
			'identifier' => 'fan_group_b',
			'title' => 'Fan Group B Content',
			'content' => 'Compare B: 49" to 60" ceiling fans have airflow efficiencies ranging from approximately 51 to 176 cubic feet per minute per watt at high speed.'
		),
    array(
			'identifier' => 'fan_group_c',
			'title' => 'Fan Group C Content',
			'content' => 'Compare C: 49" to 60" ceiling fans have airflow efficiencies ranging from approximately 51 to 176 cubic feet per minute per watt at high speed.'
		),
    array(
			'identifier' => 'fan_group_d',
			'title' => 'Fan Group D Content',
			'content' => 'Compare D: 49" to 60" ceiling fans have airflow efficiencies ranging from approximately 51 to 176 cubic feet per minute per watt at high speed.'
		),
);

$cmsBlock = Mage::getModel('cms/block');

foreach ($blocks as $_block) {

	try {
		$cmid = $cmsBlock->load($_block['identifier'])->getBlockId();
		if ($cmid) {
			$cmsBlock->setTitle($_block['title']);
			$cmsBlock->setContent($_block['content']);
		} else {
			$cmsBlock->setData($_block);
		}
		
		$cmsBlock->setStores(0);
		$cmsBlock->save();
		$cmsBlock->unsetData();
	} catch (Exception $e) {
		$msg = "Static Block " . $_block['identifier'] . 'could not be created => ';
		$msg .= $e->getMessage();
		Mage::log($msg, null, 'static_blocks_error.log', true);
		Mage::logException($e);
	}

}

$installer->endSetup();