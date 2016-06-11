<?php

include_once(__DIR__.'/Record.class.php');

class GiftCertificateException extends RecordException
{
}

class GiftCertificateRecord extends Record
{
	public function validateProperty($propName, $propValue)
	{
		//@todo: add specific validations
		//if an property values is invalid then throw a specific error; it is caught in "controller" script
		//and an error message is set (append) to the view
		
		//dummy validations, all fields should be not-empty
		if($propValue)
		{
			return;
		}
		//property is empty, throw an exception
		$errMsg='';
		switch($propName)
		{
			case 'giftTicketAmount':
				$errMsg='Ticket amount and cost are required';
				break;
			case 'giftTicketTheme':
				$errMsg='Ticket theme is required';
				break;
			case 'giftTicketMessage':
				$errMsg='Ticket message is required';
				break;
			case 'recipientEmail':
				$errMsg='Ticket recipient email is required';
				
				break;
		}
		
		if($errMsg)
		{
			throw new GiftCertificateException($errMsg);
		}
	}
	/**
	 * save - dummy method for inserting data to database
	 */
	public function save()
	{
		
		$query='INSERT INTO gift_certificates
			(
			amount,
			cost,
			theme,
			message,
			recipeint_email,
			img_blob
			)
			VALUES
			(
				'.$this->giftTicketAmount.',
				'.$this->giftTicketCost.',
				\''.$this->giftTicketTheme.'\',
				\''.$this->giftTicketMessage.'\',
				\''.$this->recipientEmail.'\',
				\''.$this->db->real_escape_string($this->imgBlob).'\'
			)';
		
		if($this->db->query($query)===false)
		{
			throw new GiftCertificateException();
		}
		
	}
}