<?php

if (Mage::helper('googleconnect/version')->isEE()) {
    class AW_Google_Connect_Helper_Data extends AW_Google_Connect_Helper_Enterprise
    {
    }
} else {
    class AW_Google_Connect_Helper_Data extends AW_Google_Connect_Helper_Community
    {
    }
}
 
 

