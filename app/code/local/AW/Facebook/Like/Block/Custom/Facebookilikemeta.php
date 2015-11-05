<?php

class AW_Facebook_Like_Block_Custom_Facebookilikemeta extends AW_Facebook_Like_Block_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('facebookilike/custom/facebookilikemeta.phtml');
    }

    protected function _getMetaTagsContent($property, $content)
    {
        switch ($property) {
            case 'type':
                return $content ? $content : 'article';

            case 'image':
                $thumb = $catimage = null;
                if ($current_product = Mage::registry('current_product')) {
                    $thumb = $current_product->getThumbnailUrl(100, 100);
                }
                if ($current_category = Mage::registry('current_category')) {
                    $catimage = $current_category->getImageUrl();
                }
                return $thumb ? $thumb : ($catimage ? $catimage : $content);

            default:
                return $content;
        }
    }
}
