<?php
if (Mage::helper('facebookconnect/version')->isEE()) {
    class AW_Facebook_Connect_Helper_Data extends AW_Facebook_Connect_Helper_Enterprise
    {
    }
} else {
    class AW_Facebook_Connect_Helper_Data extends AW_Facebook_Connect_Helper_Community
    {
    }
}
 
 

