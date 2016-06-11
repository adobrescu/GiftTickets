<?php

//Dummy empty class. It just impersonate a real framework "View" class from which this app classes inherits.

class View
{
	protected $_propsData;
	
	//just store props, no validations
	public function __set($propName, $propValue)
	{
		$this->_propsData[$propName]=$propValue;
	}
	public function &__get($propName)
	{
		if(isset($this->_propsData[$propName]))
		{
			return $this->_propsData[$propName];
		}
		$null=null;
		return $null;
	}
}