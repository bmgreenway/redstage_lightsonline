<?php

$urls = array();  

$DomDocument = new DOMDocument();
$DomDocument->preserveWhiteSpace = false;
$DomDocument->load('sitemap/sitemap.xml');
$DomNodeList = $DomDocument->getElementsByTagName('loc');

foreach($DomNodeList as $url) {
    //$urls[] = $url->nodeValue;
    echo $url->nodeValue."<br />";
}

echo "FINISHED";
// echo "<pre>";
// print_r($urls);
// echo "</pre>";