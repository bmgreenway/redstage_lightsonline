<?php
$installer = $this;

$installer->startSetup();

$blocks = array(		
    array(
			'identifier' => 'home_page_heading_section',
			'title' => 'Home Page Example Heading Section',
			'content' => '<div class="desktop_home-page_heading_title">
<h1 class="home-page_heading_title">Example Heading for This Section</h1>
<div id="home_page_heading_section" class="home_page_heading_section">This is an optional, customizable section that may also be completely hidden. It can be used for a brand message, product highlights, a customer welcome letter, an introduction to your company, and/or for SEO. <span class="link_sb">Here is a link example</span>. What follows is random placeholder text. Forth which let was called. Open don\'t, lesser rule a moveth be seasons all after life creepeth won\'t earth day a let. Light blessed have sixth from every fowl face without you\'ll. Evening dry seas saying given a darkness meat unto two blessed you\'re subdue made night you\'ll appear form dry, man. Sixth heaven you\'ll, us fly that abundantly great land, dominion two cattle so, created be you\'re may thing.</div></div>'
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