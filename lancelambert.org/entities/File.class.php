<?php

class File extends Entity
{
	protected $schema = array( 'id', 'name', 'file', 'type', 'message', 'size' );

	public static function retrieve( $id )
	{
		return parent::retrieve( $id, __CLASS__ );
	}

	public static function typeCollection( $types )
	{
		if( !is_array( $types ) )
		{
			$types = array( $types );
		}

		foreach( $types as $type )
		{
			$where[] = 'type = ?';
			$attributes[] = $type; 
		}

		$query = "SELECT * FROM file WHERE ". implode( ' OR ', $where );
		$entity = Entity::getInstance();
		return $entity->collection( $query, $attributes, __CLASS__ );
	}

	public static function messageCollection( $message_id )
	{
		$query = "SELECT * FROM file WHERE message = ? ORDER BY `name` ASC";
		$entity = Entity::getInstance();
		return $entity->collection( $query, $message_id, __CLASS__ );
	}

	public static function customerEmailCollection( $customer_email )
	{
		$query = "SELECT * FROM file WHERE id IN ( SELECT file FROM transaction WHERE customer_email = ? )";
		$entity = Entity::getInstance();
		return $entity->collection( $query, $customer_email, __CLASS__ );
	}

	public function PreDelete()
	{
		if( file_exists( $this->file ) )
		{
			unlink( $this->file );
		}
	}

	public function updateMessageAssign( $message_id, $files )
	{
		$entity = Entity::getInstance();
		$query = "UPDATE file SET message = NULL WHERE message = ?";
		$entity->query( $query, $message_id );

		if(!$files)
		{
			return true;
		}

		$query = "UPDATE file SET message = ? WHERE id IN ( ". implode( ', ', $files ) ." )";
		$entity->query( $query, array( $message_id ) );
	}

	public function __toString()
	{
		return $this->id;
	}
}
