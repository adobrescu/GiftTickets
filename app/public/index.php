<?php
//this script acts as a framework "controller"
//the code below shoud stay in a real framework controller method

include_once(__DIR__.'/../config/init.inc.php');
include_once(__DIR__.'/../lib/php/GiftCertificateView.class.php');
include_once(__DIR__.'/../lib/php/GiftCertificateRecord.class.php');

//start controller "method"
//create gift certificate view and display it

$view=new GiftCertificateView(HTML_TEMPLATE_DIR.'/GiftCertificatePageTemplate.html');

if(isset($_POST['cmd_x']))
{
	global $_db;
	
	$_POST['imgBlob']=base64_decode(substr($_POST['imgBlob'], 23));
	
	$arr=explode('|', $_POST['giftTicketAmount']);
	$_POST['giftTicketAmount']=$arr[0];
	$_POST['giftTicketCost']=isset($arr[1])?$arr[1]:0;
	
	$record=new GiftCertificateRecord($_db);
	
	foreach(array('giftTicketAmount', 'giftTicketCost', 'giftTicketTheme', 'giftTicketMessage', 'recipientEmail', 'imgBlob') as $propName)
	{
		//set view's and record properties
		//the view doesn't validate anything
		//when the record thorows exceptions about invalid data, collect them and create an error message for each of them
		$view->$propName=$_POST[$propName];
		
		try
		{
			
			$record->$propName=$_POST[$propName];			
		}
		catch(Exception $err)
		{
			$view->errorMessage='An error has occured';
		}
		/*
		//@todo: better catch different errors to built specific error messages
		catch(RecordException $err)
		{
			//catch basic db errors, field types, length etc
		}
		catch(GiftCertificateException $giftCertificateErr)
		{
			//catch GiftCerticate specific errors
		}
		 * 
		 */
	}
	//there are no errors, save the record
	try
	{
		$record->save();
		
		//@todo: redirect a a "thank you"/ticket details page instead of showing message
		$view->message='GiftTicket successfully saved';
	}
	catch(Exception $err)
	{
		$view->errorMessage='A database error has occured ';
	}
}



$view->show();
