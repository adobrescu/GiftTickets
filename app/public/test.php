<?php
//this script acts as a framework "controller"
//the code below shoud stay in a real framework controller method

include_once(__DIR__.'/../config/init.inc.php');


$query='SELECT *
	FROM gift_certificates
	ORDER BY id DESC'; //newest first

$result=$_db->query($query);

if ($result->num_rows>0)
{
	$recordset=$result->fetch_all(MYSQLI_ASSOC);
	
}

$result->free();
?>
<!DOCTYPE HTML>
<html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<title>View Gift Certificates</title>
		<style>
			/* float clearing for IE6 */
			* html .clearfix
			{
				 height: 1%;
				 overflow: visible;
			}
			/* float clearing for IE7 */
			*+html .clearfix
			{
				 min-height: 1%;
			}
			/* float clearing for everyone else */
			.clearfix:after
			{
				 clear: both;
				 content: ".";
				 display: block;
				 height: 0;
				 visibility: hidden;
			}
			body
			{
				margin: 0;
				padding: 20px;
			}
			.gift-certificate-img,
			.gift-certificate-info
			{
				float: left;
			}
			.gift-certificate-img
			{
				margin-right: 20px;
			}
			.gift-certificate-wrapper
			{
				margin-bottom: 20px;
				border: px red solid;
			}
			/*end clearfix*/
		</style>
	</head>
	<body onload="bodyOnLoad()">
		<h1>Gift Certificates</h1>
<?php
foreach($recordset as $record)
{
?>
		<div class="gift-certificate-wrapper clearfix">
			<img src="view-gift-ticket.php?id=<?=$record['id']?>" class="gift-certificate-img">
			<div class="gift-certificate-info clearfix">
				<div class="clearfix"><span class="label">Amount: </span>$<?=$record['amount']?></div>
				<div class="clearfix"><span class="label">Cost: </span>$<?=$record['cost']?></div>
				<div class="clearfix"><span class="label">Message: </span><?=$record['message']?></div>
				<div class="clearfix"><span class="label">Recipient Email Address: </span><?=$record['recipeint_email']?></div>
			</div>
		</div>
<?php
}
?>
	</body>
</html>