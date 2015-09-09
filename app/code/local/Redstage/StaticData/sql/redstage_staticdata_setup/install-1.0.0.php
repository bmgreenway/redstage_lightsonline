<?php
$installer = $this;

$installer->startSetup();

$blocks = array(
		array(
			'identifier' => 'home_page_heading_section',
			'title' => 'Home Page Example Heading Section',
			'content' => '<h1 class="home-page_heading_title">Example Heading for This Section</h1>
<div class="home_page_heading_section">This is an optional, customizable section that may also be completely hidden. It can be used for a brand message, product highlights, a customer welcome letter, an introduction to your company, and/or for SEO. <span class="link_sb">Here is a link example</span>. What follows is random placeholder text. Forth which let was called. Open don\'t, lesser rule a moveth be seasons all after life creepeth won\'t earth day a let. Light blessed have sixth from every fowl face without you\'ll. Evening dry seas saying given a darkness meat unto two blessed you\'re subdue made night you\'ll appear form dry, man. Sixth heaven you\'ll, us fly that abundantly great land, dominion two cattle so, created be you\'re may thing.</div>'
		),
    array(
			'identifier' => 'header_call_us_toll_free',
			'title' => 'Header call us toll free',
			'content' => '<span class="qustion_link">Questions?</span><span class="tel_link">Call us toll free: <a class="highlight" href="tel:18666883562">1-866-688-3562</a></span>'
		),
    array(
			'identifier' => 'header_free_shipping',
			'title' => 'Header free shipping',
			'content' => '<div class="link_header_1">Free Shipping<span class="asterisk">*</span></div>
<div class="link_header_1">110% Price Match<span class="asterisk">*</span></div>
<div class="link_header_1">No Restock Fees<span class="asterisk">*</span></div>'
		),
    array(
			'identifier' => 'footer_newsletter_subscription_text',
			'title' => 'Footer Newsletter Subscription Text',
			'content' => 'Drop us your email,<br /> <span>We&rsquo;ll send you <em>discounts</em></span>.'
		),
    array(
			'identifier' => 'footer_shop_links',
			'title' => 'Footer Shop Links',
			'content' => '<div class="block-title"><strong><span>Shop</span></strong></div>
<ul>
<li><a href="#">Ceiling Lights</a></li>
<li><a href="#">Wall Lights</a></li>
<li><a href="#">Lamps</a></li>
<li><a href="#">Ceiling Fans</a></li>
<li><a href="#">Outdoor Lights</a></li>
<li><a href="#">Home Decor</a></li>
<li><a href="#">Sale</a></li>
</ul>'
		),
    array(
			'identifier' => 'footer_account_links',
			'title' => 'Footer Account Links',
			'content' => '<div class="block-title"><strong><span>Account</span></strong></div>
<ul>
<li><a href="{{store url=\'customer/account/login\'}}">My Account</a></li>
<li><a href="{{store url=\'wishlist\'}}">My Wish List</a></li>
<li><a href="#">My Order History</a></li>
<li><a href="#">Where is my package?</a></li>
<li><a href="#">Returns</a></li>
<li><a href="#">Customer Service</a></li>
</ul>'
		),
		array(
			'identifier' => 'footer_aboutus_links',
			'title' => 'Footer About Us Links',
			'content' => '<div class="block-title"><strong><span>About Us</span></strong></div>
<ul>
<li><a href="{{store direct_url="about-magento-demo-store"}}">About Us</a></li>
<li><a href="{{store url=""}}contacts/">Contact Us</a></li>
<li><a href="#">Our Blog</a></li>
<li><a href="#">News</a></li>
<li><a href="#">FAQs</a></li>
<li><a href="#">Return Policy</a></li>
<li><a href="#">Affiliate Program</a></li>
</ul>'
		),
		array(
			'identifier' => 'footer_learn_links',
			'title' => 'Footer Learn Links',
			'content' => '<div class="block-title"><strong><span>Learn</span></strong></div>
<ul>
<li><a href="#">Lighting Trends</a></li>
<li><a href="#">Lighting Styles</a></li>
<li><a href="#">Lighting Ideas</a></li>
<li><a href="#">How-To Guides</a></li>
<li><a href="#">Buying Guides</a></li>
</ul>'
		),
		array(
			'identifier' => 'footer_social_trust_logos',
			'title' => 'Footer social icons and Trust logos',
			'content' => '<div class="social"><a href="#"><img alt="Facebook" src="{{skin url=\'images/icn-fb.png\'}}" /></a> <a href="#"><img alt="Twitter" src="{{skin url=\'images/icn-tw.png\'}}" /></a> <a href="#"><img alt="arrow" src="{{skin url=\'images/icn-pin.png\'}}" /></a> <a href="#"><img alt="Google Plus" src="{{skin url=\'images/icn-gplus.png\'}}" /></a></div>
<div class="clear">&nbsp;</div>
<ul class="everycompany">
<li><a class="icnekomi" href="#"><img alt="Ekomi" src="{{skin url=\'images/icn-ekomi.png\'}}" /></a></li>
<li><a class="icnbbb" href="#"><img alt="BBB" src="{{skin url=\'images/icn-bbb.png\'}}" /></a></li>
<li><a class="icnauthorize" href="#"><img alt="Authorize" src="{{skin url=\'images/icn-authorize.png\'}}" /></a></li>
<li><a class="icnhot100" href="#"><img alt="Hot100zone" src="{{skin url=\'images/icn-hot100zone.png\'}}" /></a></li>
<li><a class="icnehouzz" href="#"><img alt="Houzz" src="{{skin url=\'images/icn-houzz.png\'}}" /></a></li>
</ul>'
		),
		array(
			'identifier' => 'footer_terms_privacy_policy',
			'title' => 'Footer Terms and Privacy Policy',
			'content' => '<ul class="ftmenu">
<li><a href="#">Terms &nbsp; Conditions</a></li>
<li><a href="#">Privacy Policy</a></li>
</ul>'
		),
		array(
			'identifier' => 'homepage_whats_hot',
			'title' => 'Homepage whats hot',
			'content' => '{{block type="catalog/product_list"&nbsp; category_id="3" template="catalog/product/whats_hot.phtml" products_count="7"}}'
		),
		array(
			'identifier' => 'footer_call_us_toll_free',
			'title' => 'Footer call us toll free',
			'content' => '<div class="que">Questions? <span>1-866-688-3562</span></div>'
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