<?php

class Message extends Entity
{
	protected $schema = array( 'id', 'published', 'date', 'content', 'price', 'pdf' );

	public static function retrieve( $id )
	{
		$object = parent::retrieve( $id, __CLASS__ );

		if( !$object )
		{
			return null;
		}

		$object->mp3 = File::messageCollection( $object->id );
		$object->pdf = File::retrieve( $object->pdf );

		return $object;
	}

	public static function adminCollection()
	{
		$query = "SELECT * FROM message WHERE `date` > 0 ORDER BY `date` DESC";
		$entity = Entity::getInstance();
		$collection = $entity->collection( $query, null, __CLASS__ );

		if( $collection ) foreach( $collection as $item )
		{
			$item->mp3 = File::messageCollection( $item->id );
		}

		return $collection;
	}

	public static function customerIdCollection( $customer_id )
	{
		if( !$customer_id )
		{
			return null;
		}

		$query = "SELECT * FROM message WHERE id IN ( SELECT message FROM transaction WHERE customer_id = ? )";
		$entity = Entity::getInstance();
		$collection = $entity->collection( $query, $customer_id, __CLASS__ );

		if( $collection ) foreach( $collection as $item )
		{
			$item->mp3 = File::messageCollection( $item->id );
		}

		return $collection;
	}

	public static function retrieveByFile( $id )
	{
		$query = "SELECT * FROM message WHERE id IN ( SELECT message FROM file WHERE id = ? )";
		$entity = Entity::getInstance();
		return $entity->getFirstResult( $query, $id, __CLASS__ );
	}

	public function frontendCollection()
	{
		$query = "SELECT * FROM message WHERE `date` > 0 AND published = 1 ORDER BY `date` DESC";
		$entity = Entity::getInstance();
		$collection = $entity->collection( $query, null, __CLASS__ );

		if( $collection ) foreach( $collection as $item )
		{
			if( $item->pdf )
			{
				$item->pdf = File::retrieve( $item->pdf );
			}

			$item->mp3 = File::messageCollection( $item->id );
		}

		return $collection;
	}

	public function getYear()
	{
		return date( 'Y', $this->date );
	}

	public function getMonth()
	{
		return date( 'F', $this->date );
	}

	public static function aboutMiddleEast()
	{
		$query = "SELECT * FROM message WHERE `date` = -1";
		$entity = Entity::getInstance();
		return $entity->getFirstResult( $query, null, __CLASS__ );
	}
}