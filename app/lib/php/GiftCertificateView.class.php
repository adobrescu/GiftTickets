<?php

//App class inheriting from framerowk's class FormView

include_once(__DIR__.'/FormView.class.php');

class GiftCertificateView extends FormView
{
	protected $templateFilename;
	
	public function __construct($templateFilename)
	{
		$this->templateFilename=$templateFilename;
	}
	public function show()
	{
		include($this->templateFilename);
	}
}