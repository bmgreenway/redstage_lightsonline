<?php

class AW_Facebook_Like_Block_Catalog_Category_Facebookilikemeta extends AW_Facebook_Like_Block_Abstract
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
                $image = null;
                if ($current_category = Mage::registry('current_category')) {
                    $image = $current_category->getImageUrl();
                }
                return $image ? $image : $content;

            default:
                return $content;
        }
    }
}
