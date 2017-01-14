<?php
class MiddleEastUpdateAdminController extends Controller
{
	public $decoration = 'admin/decoration.tpl';

	public function index()
	{
		$this->messages();
	}

	public function files()
	{
		$this->assign( 'files', File::getAll( 'File' ) );
		echo $this->decorate( 'admin/middle-east-update/files/index.tpl' );
	}

	public function training()
	{
		$this->assign( 'scripts', array( '/js/AC_RunActiveContent.js' ) );
		echo $this->decorate( 'admin/middle-east-update/training.tpl' );
	}

	public function messages()
	{
		$this->assign( 'messages', Message::adminCollection() );
		echo $this->decorate( 'admin/middle-east-update/messages/index.tpl' );
	}

	public function messageEdit( $id = null )
	{
		if( $id )
		{
			$message = Message::retrieve( $id );
		}
		else
		{
			$message = new Message();
		}

		$pdfs = File::typeCollection( array( 'application/pdf' ) );
		$mp3s = File::typeCollection( array( 'audio/mpeg', 'audio/mp3' ) );
		$form = new Form( '/admin-middle-east-update.php/messageEdit/'. $id, 'post' );
		$form->file_upload = true;
		$form->fields[ 'published' ] = new FormField( 'published', 'Published', 'select', $message->published );
		$form->fields[ 'published' ]->options = array( 0 => 'No', 1 => 'Yes' );
		$form->fields[ 'date' ] = new FormField( 'date', 'Publish date', 'text', $message->date ?  date( 'Y-m-d', $message->date ) : date( 'Y-m-d' ) );
		$form->fields[ 'content' ] = new FormField( 'content', 'Message', 'textarea', $message->content );
		$form->fields[ 'content' ]->style = "height: 600px;";
		$form->fields[ 'pdf' ] = new FormField( 'pdf', 'Pdf', 'select', $message->pdf->id );
		$pdf_options = self::getFilesArray( $pdfs );
		$pdf_options[ '' ] = '-- Please Select --';
		ksort( $pdf_options );
		$form->fields[ 'pdf' ]->options = $pdf_options;
		$form->fields[ 'mp3' ] = new FormField( 'mp3', 'MP3', 'select' );
		$form->fields[ 'mp3' ]->multiple = true;
		$form->fields[ 'mp3' ]->values = self::getFilesArray( $message->mp3 );
		$form->fields[ 'mp3' ]->options = self::getFilesArray( $mp3s );
		$form->fields[ 'price' ] = new FormField( 'price', 'Price', 'text', $message->price );

		if( $form->posted )
		{
			$form->fields[ 'content' ]->validation( 'Required' );

			if( $form->validate() )
			{
				$message->published = $form->fields[ 'published' ]->value;
				$message->date = strtotime( $form->fields[ 'date' ]->value );
				$message->pdf = $form->fields[ 'pdf' ]->value;
				$message->price = $form->fields[ 'price' ]->value;
				$message->content = $form->fields[ 'content' ]->value;
				$message->save();

				File::updateMessageAssign( $message->id, $_POST[ 'mp3' ] );
				self::userNotice( 'Message saved' );
				self::redirect( '/admin-middle-east-update.php/messages' );
			}
		}
		$this->assign( 'form', $form );
		echo $this->decorate( 'admin/middle-east-update/messages/edit.tpl' );
	}

	public function messageDelete( $id )
	{
		$message = Message::retrieve( $id );

		if( $message )
		{
			$message->delete();
			self::userNotice( 'Message deleted' );
		}
		else
		{
			self::userError( 'Message not found' );
		}

		self::redirect( '/admin-middle-east-update.php/messages' );
	}

	public function fileDelete( $id )
	{
		$file = File::retrieve( $id );

		if( $file )
		{
			$file->delete();
			self::userNotice( 'File deleted' );
		}
		else
		{
			self::userError( 'File not found' );
		}

		self::redirect( '/admin-middle-east-update.php/files' );
	}

	function fileEdit( $id = null )
	{
		if( $id )
		{
			$file = File::retrieve( $id );
		}
		else
		{
			$file = new File();
		}
		//$pdfs = File::typeCollection( 'pdf' );
		//$mp3s = File::typeCollection( 'mp3' );
		$form = new Form( '/admin-middle-east-update.php/fileEdit/'. $id, 'post' );
		$form->file_upload = true;
		$form->fields[ 'name' ] = new FormField( 'name', 'Name', 'text', $file->name );
		$form->fields[ 'file' ] = new FormField( 'file', 'New file:', 'file' );

		if( $form->posted )
		{
		//	$form->fields[ 'name' ]->validation( 'Required' );
			if( $form->validate() )
			{
				try
				{
					$file->name = trim( $form->fields[ 'name' ]->value );
					$file->price = trim( $form->fields[ 'price' ]->value );
					/*
					if( $file->file )
					{
						if( file_exists( $file->file ) )
						{
							unlink( $file->file );
						}
					}
					*/

					if( !empty($_FILES[ 'file' ][ 'name'  ]) )
					{
						if( $_FILES[ 'file' ][ 'error' ] == 1 )
						{
							throw new Exception( 'File exceeded allowed size '. ini_get( 'upload_max_filesize' ) );
						}
						elseif( $_FILES[ 'file' ][ 'error' ] > 0 )
						{
							throw new Exception( 'Error uploading file. Error code: '. $_FILES[ 'file' ][ 'error' ] );
						}

						if( file_exists( ASSETS_PATH . $_FILES[ 'file' ][ 'name' ] ) )
						{
							throw new Exception( 'File with the same filename already exists.' );
						}

						if( move_uploaded_file( $_FILES[ 'file' ][ 'tmp_name' ], ASSETS_PATH . $_FILES[ 'file' ][ 'name' ] ) )
						{
							$file->file = ASSETS_PATH . $_FILES[ 'file' ][ 'name' ];
							$file->type = $_FILES[ 'file' ][ 'type' ];
							$file->size = $_FILES[ 'file' ][ 'size' ];
						}
						else
						{
							throw new Exception( 'File not uploaded. '. ASSETS_PATH . $_FILES[ 'file' ][ 'name' ] );
						}
					}

					$file->save();
					self::userNotice( 'file saved' );
					self::redirect( '/admin-middle-east-update.php/files/' );
				}
				catch( Exception $e )
				{
					self::userError( $e->getMessage() );
					self::redirect( '/admin-middle-east-update.php/files/' );
				}
			}
		}
		$this->assign( 'file', $file );
		$this->assign( 'form', $form );
		echo $this->decorate( 'admin/middle-east-update/files/edit.tpl' );
	}

	protected static function getFilesArray( $files )
	{
		$array = array();

		if( $files ) foreach( $files as $file )
		{
			$array[ $file->id ] = $file->name;
		}

		natcasesort($array);
		return $array;
	}

	public function about()
	{
		$message = Message::aboutMiddleEast();
		if( !$message )
		{
			$message = new Message();
			$message->date = -1;
		}

		$form = new Form( '/admin-middle-east-update.php/about/', 'post' );
		$form->file_upload = true;
		$form->fields[ 'published' ] = new FormField( 'published', 'Published', 'select', $message->published );
		$form->fields[ 'published' ]->options = array( 0 => 'No', 1 => 'Yes' );
		$form->fields[ 'content' ] = new FormField( 'content', 'Message', 'textarea', $message->content );
		$form->fields[ 'content' ]->style = "height: 600px;";
		if( $form->posted )
		{
			$form->fields[ 'content' ]->validation( 'Required' );
			if( $form->validate() )
			{
				$message->published = $form->fields[ 'published' ]->value;
				$message->content = $form->fields[ 'content' ]->value;
				$message->save();
				self::userNotice( 'About Middle East - saved' );
				self::redirect( '/admin-middle-east-update.php/about/' );
			}
		}
		$this->assign( 'form', $form );
		echo $this->decorate( 'admin/middle-east-update/messages/about.tpl' );
	}

	public function download( $id )
	{
		ini_set( 'display_errors', 'On' );

		$file = File::retrieve( $id );

		if( !$file )
		{
			return $this->notFound();
		}

		$message = Message::retrieveByFile( $id );

		if( !file_exists( $file->file ) )
		{
			throw new Exception( 'File '. $file->file .' does not exist' );
		}

		header( 'Content-disposition: attachment; filename="'. basename( $file->file ) .'"; size: '. $file->size );
		header( "Content-Type: {$file->type}" );
		header( "Content-type: application/octet-stream" );
		readfile( $file->file );
	}

}
