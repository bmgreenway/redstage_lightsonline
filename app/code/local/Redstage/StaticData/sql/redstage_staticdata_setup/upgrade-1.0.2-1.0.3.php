<?php
$installer = $this;

$installer->startSetup();

$blocks = array(		
    array(
			'identifier' => 'header_free_shipping_mobile',
			'title' => 'Header Free Shipping Mobile',
			'content' => '<div class="link_header_1">
Free Shipping over $49
</div>'
		),
		 array(
			'identifier' => 'header_free_shipping',
			'title' => 'Header free shipping',
			'content' => '<div class="header_section_one">
<div class="link_header_1">Free Shipping<span class="asterisk">*</span></div>
<div class="link_header_1">110% Price Match<span class="asterisk">*</span></div>
<div class="link_header_1">No Restock Fees<span class="asterisk">*</span></div>
</div>
'
		)
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