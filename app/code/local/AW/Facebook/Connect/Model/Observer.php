<?php

class AW_Facebook_Connect_Model_Observer
{

    public function processSalesOrderSaveAfter($observer)
    {
        if (!$this->_getHelper()->isEnabled()
            || !($order = $observer->getEvent()->getOrder())
            || !($order instanceof Mage_Sales_Model_Order)
            || !$this->_getHelper()->isPostEnabled($order)
            || !$facebook = $this->_getHelper()->getFacebook()
        ) {
            return $this;
        }

        if (!$this->_getHelper()->getPublishOrder()) {
            return $this;
        }

        $order_state = $order->getStatus() ? $order->getStatus() : $order->getState();
        if (!$order_state) {
            $order_state = (string)$order->getConfig()->getStateDefaultStatus($order->getState());
        }
        if ($order_state != $this->_getHelper()->getPostOrderStatus()) {
            return $this;
        }

        Mage::getModel('facebookconnect/order')->setFacebook($this->_getHelper()->getFacebook())->post($order, $observer);
        return $this;
    }

    public function shareWishlistViaFacebook($observer)
    {
        $data = $observer->getData('controller_action')->getRequest()->getParams();
        if (isset($data['share_via_facebook'])) {
            $this->_postWishlist();
        }
        return true;
    }

    private function _postWishlist()
    {
        $facebook   = $this->_getHelper()->getFacebook();
        $customerId = Mage::getSingleton('customer/session')->getCustomerId();
        $customer   = Mage::getModel('customer/customer')->load($customerId);
        $facebook   = $facebook->getFacebook()->setAccessToken($customer->getFbAccessToken());
        $fbUser     = $facebook->getUser();
        if ($fbUser) {
            $wishlist    = Mage::getModel('wishlist/wishlist')->loadByCustomer($customerId, true);
            $wishlistUrl = Mage::getUrl('wishlist/shared/index', array('code' => $wishlist->getSharingCode()));
            $wishlist->setShared(1);
            $wishlist->save();
            $wishlist = Mage::app()->getLayout()->createBlock('wishlist/share_wishlist');
            $media    = array();

            $urlConfig      = array(
                '_secure'       => $this->_getHelper()->isSecure(),
                '_use_rewrite'  => $this->_getHelper()->useRewrite(),
                '_store_to_url' => $this->_getHelper()->addCode(),
            );
            $storeLink      = Mage::getUrl('', $urlConfig);
            $useRewrite     = $this->_getHelper()->useRewrite();
            $description    = '';
            $defaultComment = Mage::helper('wishlist')->defaultCommentString();
            foreach ($wishlist->getWishlistItems() as $item) {
                // magento 1.4.2.0 fix
                if (get_class($item) === 'Mage_Catalog_Model_Product') {
                    $_product = $item;
                    if ($defaultComment != $item->getWishlistItemDescription()) {
                        $description = $item->getWishlistItemDescription();
                    }
                } else {
                    $_product = $item->getProduct();
                    if ($defaultComment != $item->getData('description')) {
                        $description .= $item->getData('description');
                    }
                }
                $_product->load($_product->getId());
                $productLink = 'catalog/product/view/id/' . $_product->getId();
                if ($useRewrite) {
                    $productLink = $this->_getHelper()->getProductRewriteUrl($_product->getId());
                }
                $media[] = array(
                    'type' => 'image',
                    'src'  => $_product->getImageUrl(),
                    'href' => $storeLink . $productLink,
                );
            }

            $message = $this->_getHelper()->getWallWishlistTemplate();
            $message = str_replace('{store_link}', $storeLink, $message);
            $message = str_replace('{wishlist_link}', $wishlistUrl, $message);
            $param   = array(
                'method'     => 'stream.publish',
                'message'    => $message,
                'attachment' => array(
                    'description' => $description,
                    'media'       => $media,
                ),
            );

            try {
                $facebook->api($param);
                Mage::getSingleton('customer/session')->addSuccess(
                    $this->_getHelper()->__('Your Wishlist has been shared.')
                );
            } catch (Exception $exc) {
                Mage::log($exc->getMessage());
                Mage::getSingleton('customer/session')->addError(
                    $this->_getHelper()->__('Your Wishlist has not been shared.')
                );
            }
        } else {
            Mage::getSingleton('customer/session')->addError(
                $this->_getHelper()->__('Your Wishlist has not been shared.')
            );
        }
        return true;
    }

    /**
     * @return AW_Facebook_Connect_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('facebookconnect');
    }
}