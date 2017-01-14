<?php

class Postcode
{
	function validate( $country, $zip_code)
	{
		$method = "validate_{$country}";

		if( method_exists( 'postcode', $method ) )
		{
			return self::$method( trim( $zip_code ) );
		}
		else
		{
			return true;
		}
	}
	
	function validate_US( $zip_code )
	{
		if( preg_match("/^([0-9]{5})(-[0-9]{4})?$/i", $zip_code ) )
			return true;
		else
			return false;
	}
	
	function validate_CA( $zip_code )
	{
		 if( preg_match("/^([a-ceghj-npr-tv-z]){1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[ ]{0,1}[0-9]{1}[a-ceghj-npr-tv-z]{1}[0-9]{1}$/i", $zip_code ) )
 
			return true;
		else
			return false;
	}
}
