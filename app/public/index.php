<?php
//this script acts as a framework "controller"
//the code below shoud stay in a real framework controller methods

include_once(__DIR__.'/../config/init.inc.php');
include_once(__DIR__.'/../lib/php/GiftCertificateView.class.php');

//start controller "method"
//create gift certificate view and display it

$view=new GiftCertificateView(HTML_TEMPLATE_DIR.'/GiftCertificatePageTemplate.html');
if(isset($_POST['cmd_x']))
{
	
	foreach(array('giftTicketAmount', 'giftTicketTheme', 'giftTicketMessage', 'recipientEmail') as $propName)
	{
		if($propName=='giftTicketAmount')
		{
			$arr=explode('|', $_POST['giftTicketAmount']);
			$view->giftTicketAmount=$arr[0];
			
			$view->giftTicketCost=isset($arr[1])?$arr[1]:0;
			
			continue;
		}
		
		$view->$propName=$_POST[$propName];
	}
}



$view->show();
