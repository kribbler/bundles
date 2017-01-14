<?php

class PropheticController extends Controller
{
	public function index()
	{
		echo $this->decorate( 'prophetic/index4.tpl' );
	}

	public function message( $id )
	{
		if( !in_array( $id, array( 1, 2, 3, 4, 5, 6, 7 ) ) )
		{
			$this->notFound();
		}

		echo $this->decorate( 'prophetic/message-'. $id .'.tpl' );
	}
}
