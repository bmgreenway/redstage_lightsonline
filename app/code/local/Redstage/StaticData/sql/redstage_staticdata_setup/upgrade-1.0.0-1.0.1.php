<?php
$installer = $this;

$installer->startSetup();

$blocks = array(		
    array(
			'identifier' => 'footer_shop_links',
			'title' => 'Footer Shop Links',
			'content' => '<div id="footer_shop_links">
<ul>
<li><a href="#">Ceiling Lights</a></li>
<li><a href="#">Wall Lights</a></li>
<li><a href="#">Lamps</a></li>
<li><a href="#">Ceiling Fans</a></li>
<li><a href="#">Outdoor Lights</a></li>
<li><a href="#">Home Decor</a></li>
<li><a href="#">Sale</a></li>
</ul>
</div>'
		),
    array(
			'identifier' => 'footer_account_links',
			'title' => 'Footer Account Links',
			'content' => '<div id="footer_account_links">
<ul>
<li><a href="{{store url=\'customer/account/login\'}}">My Account</a></li>
<li><a href="{{store url=\'wishlist\'}}">My Wish List</a></li>
<li><a href="#">My Order History</a></li>
<li><a href="#">Where is my package?</a></li>
<li><a href="#">Returns</a></li>
<li><a href="#">Customer Service</a></li>
</ul>
</div>'
		),
		array(
			'identifier' => 'footer_aboutus_links',
			'title' => 'Footer About Us Links',
			'content' => '<div id="footer_aboutus_links">
<ul>
<li><a href="{{store direct_url="about-magento-demo-store"}}">About Us</a></li>
<li><a href="{{store url=""}}contacts/">Contact Us</a></li>
<li><a href="#">Our Blog</a></li>
<li><a href="#">News</a></li>
<li><a href="#">FAQs</a></li>
<li><a href="#">Return Policy</a></li>
<li><a href="#">Affiliate Program</a></li>
</ul>
</div>'
		),
		array(
			'identifier' => 'footer_learn_links',
			'title' => 'Footer Learn Links',
			'content' => '<div id="footer_learn_links">
<ul>
<li><a href="#">Lighting Trends</a></li>
<li><a href="#">Lighting Styles</a></li>
<li><a href="#">Lighting Ideas</a></li>
<li><a href="#">How-To Guides</a></li>
<li><a href="#">Buying Guides</a></li>
</ul>
</div>'
		),
		array(
			'identifier' => 'homepage_whats_hot',
			'title' => 'Homepage whats hot',
			'content' => '<div class="whats_hot_title">WHAT\'S HOT</div>
<p>{{block type="catalog/product_list"&nbsp; category_id="3" template="catalog/product/whats_hot.phtml" }}</p>'
		),
		array(
			'identifier' => 'discount_block_homepage',
			'title' => 'Discount block homepage',
			'content' => '<div class="discount_block_homepage">
<div class="discount_block_homepage_inner"><span class="font_regular">Save 15%</span> on all Savoy House Lighting <span class="font_regular">10% off </span>Hinkley Outdoor Lighting through 5/31<span class="see_all_codes_main"><span class="see_all_codes"> See all Coupon Codes</span></span><span class="see_all_codes_icon">.</span></div>
</div>'
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