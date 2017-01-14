<?php

class Transaction extends Entity
{
	public $schema = array( 'id', 'message', 'customer_email', 'customer_id', 'customer_name', 'price', 'date', 'paypal_id' );

	public static function retrieve( $id )
	{
		return parent::retrieve( $id, __CLASS__ );
	}

	public static function retrieveCustomerByEmail( $email )
	{
		$query = "SELECT * FROM transaction WHERE customer_email = ?";
		$entity = Entity::getInstance();
		$transaction = $entity->getFirstResult( $query, $email, __CLASS__ );

		if( !$transaction )
		{
			return null;
		}

		$query = "UPDATE transaction SET customer_id = ? WHERE customer_email = ?";
		$entity->query( $query, array( $transaction->customer_id, $email ) );

		return $transaction->customer_id;
	}

	public static function retrieveByFileAndCustomer( $file, $customer_id )
	{
		$query = "SELECT * FROM transaction WHERE message IN ( SELECT message FROM file WHERE id = ? ) AND customer_id = ?";
		$entity = Entity::getInstance();
		return $entity->getFirstResult( $query, array( $file, $customer_id ), __CLASS__ );
	}

	public static function retrieveByMessage( $id )
	{
		$query = "SELECT * FROM transaction WHERE message = ?";
		$entity = Entity::getInstance();
		return $entity->getFirstResult( $query, array( $id ), __CLASS__ );
	}
}
