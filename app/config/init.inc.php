<?php

	//config settings (db, upload dir etc, libs dir, html templates dir)

	define('HTML_TEMPLATE_DIR', __DIR__.'/../lib/html-templates');
	
	$_amounts=array(
		'20.00' => '22.75',
		'25.00' => '24.00'
	);
	$_themes=array(
		'Birthday' => 'Birthday',
		'Celebration' => 'Celebration'
	);
	
	$_db=new Mysqli('localhost', 'root', '', 'gift_certificates');

	