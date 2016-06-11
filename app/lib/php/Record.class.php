<?php

//Dummy empty classes. It just impersonate a real framework "View" class from which this app classes inherits.

class RecordException extends Exception
{
}

class Record
{
	protected $_data, $db;
	public function __construct($db)
	{
		$this->db=$db;
	}
	//just store props, no validations
	public function __set($propName, $propValue)
	{
		$this->validateProperty($propName, $propValue);
		
		$this->_data[$propName]=$propValue;
	}
	public function &__get($propName)
	{
		if(isset($this->_data[$propName]))
		{
			return $this->_data[$propName];
		}
		$null=null;
		return $null;
	}
	public function validateProperty($propName, $propValue)
	{
		//basic validations, types, lengths etc
	}
}