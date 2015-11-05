<?php

class AW_Google_Connect_Block_Login extends Mage_Core_Block_Template
{
    public function getAuthUrl()
    {
        return Mage::registry('google_auth_url');
    }
}