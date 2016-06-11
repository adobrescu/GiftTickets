<?php

	//config settings (db, upload dir etc, libs dir, html templates dir)

	define('HTML_TEMPLATE_DIR', __DIR__.'/../lib/html-templates');
	
	//db settings
	
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'gift_certificates');
	
	$_amounts=array(
		'20.00' => '22.75',
		'25.00' => '26.00'
	);
	$_themes=array(
		'Birthday' => 'Birthday',
		'Celebration' => 'Celebration'
	);
	
	$_db=new Mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

	