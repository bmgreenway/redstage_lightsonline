<?php


 if(Mage::helper('twitterconnect/version')->isEE()) {
     class AW_Twitter_Connect_Helper_Data extends AW_Twitter_Connect_Helper_Enterprise
    {	
    }
} else {	
    class AW_Twitter_Connect_Helper_Data extends AW_Twitter_Connect_Helper_Community
    {	
    }
}
 
 

