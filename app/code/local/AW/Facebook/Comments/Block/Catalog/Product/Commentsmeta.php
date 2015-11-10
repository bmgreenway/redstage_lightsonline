<?php

class AW_Facebook_Comments_Block_Catalog_Product_Commentsmeta extends AW_Facebook_Comments_Block_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('facebookcomments/commentsmeta.phtml');
    }
}
