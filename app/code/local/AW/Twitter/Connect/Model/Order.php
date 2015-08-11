<?php

class AW_Twitter_Connect_Model_Order extends Varien_Object
{
	function post($order)
	{
		try {
			$total_item = $order->getTotalItemCount();
			$order_items = $order->getItemsCollection();
			if(!count($order_items) || !$total_item) {
				return false;
			}


            $connection = Mage::helper('twitterconnect')->getTwitterConnection();

            $customer_id = $order->getCustomerId();
            if(!$customer_id){
                return false;
            }
            
			$items = array();
			foreach($order_items as $order_item) {
				if ($order_item->isDeleted()
				    || $order_item->getData('parent_item_id')
				    || !$product = $order_item->getProduct())
				{
					continue;
				}

				$item = array();
				$item['name']	= trim($order_item->getData('name'));
				if($qty = $order_item->getData('qty_ordered')) {}
				else if($qty = $order_item->getData('qty')) {}
				else $qty = 0;
				$item['qty']	= $qty;
				$item['url']	= Mage::helper('catalog/product')->getProductUrl($product);
				$item['price']	= Mage::helper('core')->currency($product->getPrice());

				$items[] = $item;
			}

			$order_to_twitter              = new stdClass();
			$order_to_twitter->totalCount  = $total_item;
			$order_to_twitter->storeName   = Mage::app()->getStore($order->getStoreId())->getName();
			$order_to_twitter->storeUrl    = Mage::getBaseUrl();
			$order_to_twitter->products    = $items;

            
            
			return $connection->twitterPost($order_to_twitter,$customer_id);

		} catch(Exception $e) {
			Mage::logException($e);
			return false;
		}
	}
}
