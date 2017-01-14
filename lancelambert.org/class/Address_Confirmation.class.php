<?php

class Address_Confirmation
{
	public $fields = array(
		'A' => 'Address only (no ZIP)',
		'B' => 'Address only (no ZIP)',
		'C' => 'No match - decline',
		'D' => 'Match',
		'E' => 'No match - decline',
		'F' => 'Match',
		'G' => 'Service unavailable',
		'I' => 'Service unavailable',
		
	);
	
	public static function Retrieve( $id )
	{
		$address_confirmation = new Address_Confirmation();
		return $address_confirmation->fields[ $id ];
	}
	
	
}
