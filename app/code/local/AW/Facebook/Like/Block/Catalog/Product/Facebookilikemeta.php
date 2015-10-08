<?php

class AW_Facebook_Like_Block_Catalog_Product_Facebookilikemeta extends AW_Facebook_Like_Block_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('facebookilike/facebookilikemeta.phtml');
    }

    protected function _getMetaTagsContent($property, $content)
    {
        switch ($property) {
            case 'type':
                return $content ? $content : 'product';

            case 'image':
                $thumb = null;
                if ($current_product = Mage::registry('current_product')) {
                    $thumb = $current_product->getThumbnailUrl(100, 100);
                }
                return $thumb ? $thumb : $content;

            default:
                return $content;
        }
    }
}
