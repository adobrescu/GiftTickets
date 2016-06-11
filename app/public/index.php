<?php
//this script acts as a framework "controller"
//the code below shoud stay in a real framework controller methods

include_once(__DIR__.'/../config/init.inc.php');
include_once(__DIR__.'/../lib/php/GiftCertificateView.class.php');

//start controller "method"
//create gift certificate view and display it

$view=new GiftCertificateView(HTML_TEMPLATE_DIR.'/GiftCertificatePageTemplate.html');

$view->show();
