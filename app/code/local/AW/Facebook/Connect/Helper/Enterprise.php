<?php

class AW_Facebook_Connect_Helper_Enterprise extends AW_Facebook_Core_Helper_Data
{
    /**
     * @param null $facebook_reset
     * @return AW_Facebook_Connect_Model_Connect
     */
    public function getFacebook($facebook_reset = null)
    {
        static $facebook = null;
        if ($facebook_reset instanceof AW_Facebook_Connect_Model_Connect) {
            $facebook = $facebook_reset;
        } else if (is_null($facebook)) {
            $facebook = Mage::getModel('facebookconnect/connect')
                ->setAppId($this->getAppID())
                ->setSecret($this->getAppSecret())
                ->setCookie(true)
                ->init();
        }
        return $facebook;
    }

    //general settings
    public function isEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = Mage::getStoreConfig('facebookconnect/general/enable_extension', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function getTitle()
    {
        static $title = null;
        if (is_null($title)) {
            $title = Mage::getStoreConfig('facebookconnect/general/title', Mage::app()->getStore()->getId());
        }
        return $title;
    }


    // content settings
    public function isLoginPageButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('facebookconnect/content/show_in_login', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isCheckoutPageButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('facebookconnect/content/show_in_checkout', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isCustomButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('facebookconnect/content/show_custom', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function isWidgetButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('facebookconnect/content/show_widget', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    //wall post settings

    public function getWallPublishOrder()
    {
        return Mage::getStoreConfig('facebookconnect/wall/publish_order', Mage::app()->getStore()->getId());
    }

    public function getWallOrderstatus()
    {
        return Mage::getStoreConfig('facebookconnect/wall/orderstatus', Mage::app()->getStore()->getId());
    }

    public function getWallMessage()
    {
        return Mage::getStoreConfig('facebookconnect/wall/post_message', Mage::app()->getStore()->getId());
    }

    public function getWallTemplate()
    {
        return Mage::getStoreConfig('facebookconnect/wall/post_link_template', Mage::app()->getStore()->getId());
    }

    public function getWallCount()
    {
        return Mage::getStoreConfig('facebookconnect/wall/items_count', Mage::app()->getStore()->getId());
    }

    public function postImagesToWall()
    {
        return Mage::getStoreConfigFlag('facebookconnect/wall/picture', Mage::app()->getStore()->getId());
    }

    public function isShareWishlistButtonEnabled()
    {
        static $is_enabled = null;
        if (is_null($is_enabled)) {
            $is_enabled = $this->isEnabled() && Mage::getStoreConfig('facebookconnect/wall/wishlist_button', Mage::app()->getStore()->getId());
        }
        return $is_enabled;
    }

    public function getWallWishlistTemplate()
    {
        return Mage::getStoreConfig('facebookconnect/wall/wishlist_share_message', Mage::app()->getStore()->getId());
    }


    //sign up section

    public function getSignupEnableMessage()
    {
        return Mage::getStoreConfig('facebookconnect/signup/signup_enable_message', Mage::app()->getStore()->getId());
    }

    public function getSignupMessage()
    {
        return Mage::getStoreConfig('facebookconnect/signup/signup_message', Mage::app()->getStore()->getId());
    }

    public function getSignupImage()
    {
        $image =  Mage::getStoreConfig('facebookconnect/signup/signup_image', Mage::app()->getStore()->getId());
        if(!$image){
            $image = $this->getStoreLogo();
        }
        return $image;
    }

    public function getSignupName()
    {
        return Mage::getStoreConfig('facebookconnect/signup/signup_name', Mage::app()->getStore()->getId());
    }

    public function getSignupDescription()
    {
        return Mage::getStoreConfig('facebookconnect/signup/signup_description', Mage::app()->getStore()->getId());
    }

    // create account section

    public function getEnableNotify()
    {
        return Mage::getStoreConfig('facebookconnect/create_account/enable_notify', Mage::app()->getStore()->getId());
    }

    public function getEmailTemplate()
    {
        return Mage::getStoreConfig('facebookconnect/create_account/email_template', Mage::app()->getStore()->getId());
    }

    public function getEmailIdentity()
    {
        return Mage::getStoreConfig('facebookconnect/create_account/email_identity', Mage::app()->getStore()->getId());
    }

    public function isPostEnabled($order = null)
    {
        if (!Mage::app()->getStore()->isAdmin()) {
            return (Mage::getSingleton('customer/session')->getCustomer()->getData('fb_wall_post') ? true : false);
        } else {
            if ($order->getCustomerId()) {
                $customerId = $order->getCustomerId();
                $customer   = Mage::getModel('customer/customer')->setWebsiteId(Mage::app()->getStore($order->getStoreId())->getWebsiteId())->load($customerId);
            } elseif ($order->getCustomerEmail()) {
                $customer_email = $order->getCustomerEmail();
                $customer       = Mage::getModel('customer/customer')
                    ->setWebsiteId(Mage::app()->getStore($order->getStoreId())->getWebsiteId())
                    ->loadByEmail($customer_email);
            } else {
                return false;
            }
            return ($customer->getData('fb_wall_post') ? true : false);
        }
    }

    public function getPostOrderStatus()
    {
        if (!$orderstatus = $this->getWallOrderstatus()) {
            return Mage_Sales_Model_Order::STATE_COMPLETE;
        }
        return $orderstatus;
    }

    public function getPublishOrder()
    {
        return $this->getWallPublishOrder();
    }

    public function setFacebookHtmlDisplayed($set = true)
    {
        Mage::register('isFacebookHtmlGenerated', $set);
    }

    public function isFacebookHtmlDisplayed()
    {
        return Mage::registry('isFacebookHtmlGenerated');
    }

    public function getFacebookHtml()
    {
        if ($facebook = $this->getFacebook()) {
            return $facebook->getFacebookHtml() . $facebook->getFacebookLoginEventHtml();
        }
        return null;
    }


    public function updateCustomerToken($access_token)
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn() && $access_token) {
            $customer_id = Mage::getModel('customer/session')->getCustomerId();
            $customer    = Mage::getModel('customer/customer')->load($customer_id);
            $customer->setFbAccessToken($access_token)->save();
        }
    }

    public function isSecure()
    {
        return Mage::getStoreConfig('web/secure/use_in_frontend', Mage::app()->getStore()->getId());
    }

    public function addCode()
    {
        return Mage::getStoreConfig('web/url/use_store', Mage::app()->getStore()->getId());
    }

    public function useRewrite()
    {
        return Mage::getStoreConfig('web/seo/use_rewrites', Mage::app()->getStore()->getId());
    }

    public function getProductRewriteUrl($productId)
    {
        $collection = Mage::getModel('core/url_rewrite')->getCollection();
        $collection->getSelect()
            ->where('product_id = ?', $productId)
            ->where('store_id = ?', Mage::app()->getStore()->getId());

        if ($collection->getSize()) {
            $path = $collection->getColumnValues('request_path');
            return reset($path);
        } else {
            return 'catalog/product/view/id/' . $productId;
        }
    }


    public function getPostMessage($order)
    {
        $orderItems    = $order->getAllVisibleItems();
        $store         = Mage::app()->getStore($order->getStoreId());
        $urlConfig     = array(
            '_secure'       => $this->isSecure(),
            '_use_rewrite'  => $this->useRewrite(),
            '_store_to_url' => $this->addCode(),
        );
        $storeLink     = Mage::getUrl('', $urlConfig);
        $message       = $this->getWallMessage();
        $messageParams = array(
            'count' => array(
                'template' => '{items_count}',
                'real'     => count($order->getAllVisibleItems()),
            ),
            'link'  => array(
                'template' => '{store_link}',
                'real'     => $storeLink
            ),
        );

        foreach ($messageParams as $param) {
            $message = str_replace($param['template'], $param['real'], $message);
        }

        $description = array();
        $media       = array();
        $countToPost = $this->getWallCount();
        $count       = ((int)$countToPost) ? min((int)$countToPost, count($orderItems)) : count($orderItems);
        for ($i = 0; $i < $count; $i++) {
            $product = $orderItems[$i];

            $productLink = 'catalog/product/view/id/' . $product->getProductId();
            if ($this->useRewrite()) {
                $productLink = $this->getProductRewriteUrl(
                    $product->getProductId()
                );
            }
            $productInfo = array(
                'count' => array(
                    'template' => '{items_count}',
                    'real'     => $product->getQtyOrdered()
                ),
                'name'  => array(
                    'template' => '{item_name}',
                    'real'     => $product->getName()
                ),
                'price' => array(
                    'template' => '{item_price}',
                    'real'     => $store->convertPrice($product->getBasePrice(), true, false)
                ),
                'link'  => array(
                    'template' => '{item_link}',
                    'real'     => $storeLink . $productLink
                ),
                'store' => array(
                    'template' => '{store_link}',
                    'real'     => $storeLink
                ),
            );
            $row         = $this->getWallTemplate();
            foreach ($productInfo as $param) {
                $row = str_replace($param['template'], $param['real'], $row);
            }
            $description[] = $row;
            if ($this->postImagesToWall()) {
                $imageUrl = Mage::getModel('catalog/product')
                    ->load($product->getProductId())
                    ->getImageUrl();
                $media[]  = array(
                    'type' => 'image',
                    'src'  => $imageUrl,
                    'href' => $storeLink . $productLink,
                );
            }
        }

        $param = array(
            'method'     => 'stream.publish',
            'message'    => $message,
            'attachment' => array(
                'description' => implode(' ', $description),
                'media'       => $media,
            ),
        );


        return $param;

    }


    public function getStoreLogo()
    {
        return Mage::getDesign()->getSkinUrl(Mage::getStoreConfig('design/header/logo_src'));
    }
}
