<?php
$installer = $this;

$installer->startSetup();

$blocks = array(		
    array(
			'identifier' => 'footer_livechat',
			'title' => 'Footer Live Chat',
			'content' => '<div data-id="PPa8MZBA4G" class="livechat_button"><a href="https://www.livechatinc.com/customer-service-software/?partner=lc_6656451&amp;utm_source=chat_button">customer service software</a></div>'
		),
    array(
			'identifier' => 'header_call_for_livechat',
			'title' => 'Header Live Chat',
			'content' => '<div class="chat_live_m">
	<div data-id="TVf8pGEAWK" class="livechat_button"><a href="https://www.livechatinc.com/help-desk-software/?partner=lc_6656451&amp;utm_source=chat_button">help desk software</a></div>
</div>
<div class="chat_live">
	<div data-id="PP3uMqCDWB" class="livechat_button"><a href="https://www.livechatinc.com/customer-service-software/?partner=lc_6656451&amp;utm_source=chat_button">customer service software</a></div>
</div>'
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