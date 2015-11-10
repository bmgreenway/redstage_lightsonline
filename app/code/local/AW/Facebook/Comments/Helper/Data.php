<?php

if (Mage::helper('facebookcomments/version')->isEE()) {
    class AW_Facebook_Comments_Helper_Data extends AW_Facebook_Comments_Helper_Enterprise
    {
    }
} else {
    class AW_Facebook_Comments_Helper_Data extends AW_Facebook_Comments_Helper_Community
    {
    }
}
 
 

