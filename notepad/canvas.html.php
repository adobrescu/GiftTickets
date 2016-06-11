<?php
	if($_POST)
	{
		$imgData=base64_decode(substr($_POST['blobData'],23 ));
		
		//needs write permissions on test.jpg
		//file_put_contents('test.jpg', $imgData);
	}
?>
<!DOCTYPE HTML>
<html class="no-js" lang="en"><!--<![endif]-->
	<head>
		<title>Play with canvas</title>
		<script type="text/javascript">
			function loadImage()
			{
				var canvas=document.getElementById("giftCertificateCanvas");
				var context=canvas.getContext("2d");
				context.drawImage(document.getElementById("giftCertificateImg"), 0, 0, 537, 321);
				context.fillText("THIS IS JUST A Test", 10, 10);
				
				//canvas.toBlob(uploadImage); //not working in IE
								
				var form=document.getElementById("giftCertificateForm");
				
				form.elements["blobData"].value=canvas.toDataURL("image/jpeg");
				
			}
			function uploadImage(blob)
			{
				console.log(blob.type);
			}
		</script>
		<style>
			canvas
			{
				border: 1px #777777 solid;
				
				float: left;
				margin-right: 20px;
			}
		</style>
	</head>
	<body>
		<canvas id="giftCertificateCanvas"></canvas>
		<img src="GiftCertificate.jpg" id="giftCertificateImg" enctype="multipart/form-data">
		<form id="giftCertificateForm" method="post">
			<input type="hidden" name="blobData">
			<input type="submit" value="Submit">
		</form>
		<a href="#" onclick="loadImage(); return false">test</a>
	</body>
</html>