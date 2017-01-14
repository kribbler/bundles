<?php
class MiddleEastUpdateController extends Controller
{
	public function __construct()
	{
		parent::__construct();

		if( !isset( $_COOKIE[ 'customer_id' ] ) || !$_COOKIE[ 'customer_id' ] )
		{
			setcookie( 'customer_id', md5( rand( 1, 1000000 ) + time() ), time() + 60 * 60 * 24 * 1365, '/', $_SERVER[ 'SERVER_NAME' ] );
		}

		error_log( var_export( $_COOKIE[ 'customer_id' ], true ) );
	}

	public function index()
	{
		$this->assign( 'messages', Message::frontendCollection() );
		$this->assign( 'about_middle_east_update', Message::aboutMiddleEast() );
		echo $this->decorate( 'middle-east-update/index.tpl' );
	}

	public function myDownloads()
	{
		if( $_POST )
		{
			$email = (string) trim( filter_input( INPUT_POST, 'email' ) );
						
			if( $email )
			{
				$customer_id = Transaction::retrieveCustomerByEmail( $email );

				if( $customer_id )
				{
					setcookie( 'customer_id', $customer_id, time() + 60 * 60 * 24 * 365, '/', $_SERVER[ 'SERVER_NAME' ] );
					self::userNotice( 'Files found for this email.' );
				}
				else
				{
					self::userError( 'It seems we have no transaction record for this email. Please check if email is correct or contact us.' );
				}
			}
		}
		$messages = Message::customerIdCollection( $customer_id ? $customer_id : $_COOKIE[ 'customer_id' ] );

		//natcasesort( $messages );

		$this->assign( 'messages', $messages );
		echo $this->decorate( 'middle-east-update/my-downloads.tpl' );
	}

	public function buy( $id )
	{
		$message = Message::retrieve( $id );
		if( !$message )
		{
			return $this->notFound();
		}

		$transaction = Transaction::retrieveByFileAndCustomer( $id, $_COOKIE[ 'customer_id' ] );
		if( $transaction )
		{
			self::redirect( '/middle-east-update.php/my-downloads/' );
		}

		if( !$_COOKIE[ 'customer_id' ] )
		{
			throw new Exception( 'Something went wrong - cookie has noot been st up. Please try refresh.' );
		}

		$this->assign( 'message', $message );
		echo $this->decorate( 'middle-east-update/buy.tpl' );
	}

	public function downloadmessage( $id )
	{
		$message = Message::retrieve( $id );

		if( !$message )
		{
			return $this->notFound();
		}

		$this->assign( 'message', $message );
		echo $this->decorate( 'middle-east-update/message-files.tpl' );
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

		if( $message->price > 0 )
		{
			$transaction = Transaction::retrieveByFileAndCustomer( $id, $_COOKIE[ 'customer_id' ] );
			if( !$transaction )
			{
				self::redirect( '/middle-east-update.php/buy/'. $message->id );
			}
		}

		if( !file_exists( $file->file ) )
		{
			die( 'File does not exist' );
		}
/*
		if( filesize( $file->file ) != $file->size )
		{
			$file->size = filesize( $file->file );
			$file->save();
		}
*/

		header( 'Content-disposition: attachment; filename="'. basename( $file->file ) .'"; size: '. $file->size );
		header( "Content-Type: {$file->type}" );
		header( "Content-type: application/octet-stream" );
		readfile( $file->file );
	}

	public function downloadZip( $id = null )
	{
		$message = Message::retrieve( $id );

		if( $message->price > 0 )
		{
			$transaction = Transaction::retrieveByMessage( $id, $_COOKIE[ 'customer_id' ] );
			if( !$transaction )
			{
				self::redirect( '/middle-east-update.php/buy/'. $message->id );
			}
		}

		$files = File::messageCollection( $message->id );
/*
		if( count( $files ) == 1 )		{
			self::redirect( "/middle-east-update/download/{$id}" );
		}
*/
		$zip_file = tempnam( '/tmp', 'zip' );

		foreach( $files as $file )
		{
			$file_list[] = '"'. $file->file . '"';
		}

		set_time_limit(0);

		$command = "zip -rj {$zip_file} ". implode( ' ', $file_list );
		$result = `{$command}`;
		$zip_file .= ".zip";
		//var_dump( $command, $result, file_exists( $zip_file ), filesize( $zip_file ) );
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=\"Message-{$message->getYear()}-{$message->getMonth()}.zip\"");
		header("Content-length: " . filesize( $zip_file ) . "\n\n");
		$file = @fopen($zip_file,"rb");

		while(!feof($file))
		{
			echo fread($file, 65536);
			flush();
		}

		@fclose($file);
		unlink( $zip_file );
		die();
	}

	public function ipn( $customer_id, $message_id )
	{
		if( ( PRODUCTION && gethostbyaddr( $_SERVER['REMOTE_ADDR'] ) == 'notify.paypal.com' ) || gethostbyaddr( $_SERVER['REMOTE_ADDR'] ) == 'ipn.sandbox.paypal.com' )
		{
			if( strtolower( $_POST['payment_status'] ) == 'completed' )
			{
				$transaction = new Transaction();
				$transaction->message = $message_id;
				$transaction->customer_email = $_POST[ 'payer_email' ];
				$transaction->customer_id = $customer_id;
				$transaction->price = $_POST[ 'mc_gross' ] ? $_POST[ 'mc_gross' ] : $_POST[ 'mc_gross_1' ];
				$transaction->date = time();
				$transaction->customer_name = $_POST[ 'address_name' ];
				$transaction->paypal_id = $_POST[ 'txn_id' ];
				$transaction->save();
			}

		}
		else
		{
			error_log( var_export( "Possible hacker attack! {$customer_id}:{$file_id}", true ) );
		}
	}
}
