<?php

class AW_Twitter_Connect_Model_Observer
{
   	function processSalesOrderSaveAfter($observer)
	{
		$order = $observer->getEvent()->getOrder();
		
		if(Mage::registry('twitter_post_order')
		    || !Mage::helper('twitterconnect')->isEnabled()
			|| !Mage::helper('twitterconnect')->isPostEnabled($order))
		{
			return $this;
		}
		
		if ($order instanceof Mage_Sales_Model_Order) {
		
			$order_state = $order->getStatus() ? $order->getStatus() : $order->getState();
					
			if (!$order_state) {
				$order_state = (string) $order->getConfig()->getStateDefaultStatus($order->getState());
			}

			if ($order_state != Mage::helper('twitterconnect')->getPostOrderStatus()) {
				return $this;
			}
			
			$isProcessed = Mage::getModel('twitterconnect/order')->post($order);
			if($isProcessed) {
			    Mage::register('twitter_post_order', true);
			}
		}

		return $this;
	}
}