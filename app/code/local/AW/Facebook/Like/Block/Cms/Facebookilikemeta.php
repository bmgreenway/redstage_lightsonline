<?php

class AW_Facebook_Like_Block_Cms_Facebookilikemeta extends AW_Facebook_Like_Block_Abstract
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
                return $content ? $content : 'article';

            default:
                return $content;
        }
    }
}
