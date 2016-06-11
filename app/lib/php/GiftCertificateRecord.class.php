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
		
		//throw new GiftCertificateException();
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