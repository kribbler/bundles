<?php


class mysqldb {

	var $_server;
	var $_username;
	var $_password;
	var $_database;
	var $_appname;
	
	var $_conn;

	var $_err_email=true;  // bool
	var $_err_display=true; //bool
	var $_flex_xml=true;
	
	function handleErr($err, $errNo=-1) {
		if ($this->_err_email) {
			$subject="MYSQL Error: " . $this->_appname;
			$body=$err;
			$this->SendMail($subject, $body, false);
		}

		if ($this->_err_display) {
			if ($this->_flex_xml) {
				flexMessage($err, $errNo);
			} else {
				echo $err;
			}
		}
	}
	 function mysqldb($appname, $server, $username, $password, $database) {

		$this->_appname=$appname;
		$this->_server=$server;
		$this->_username=$username;
		$this->_password=$password;
		$this->_database=$database;

		$this->_conn=mysql_connect($server, $username, $password)
			or $this->handleErr("Cannot connect to mySQL.","-1000");
		mysql_select_db($database)
			or $this->handleErr("Cannot select database.","-1001");
			
	}
	
	 function openRS($SQL) {
		debug(2,$SQL);
		mysql_select_db($this->_database);
		if (!@$result=mysql_query($SQL,$this->_conn)) {
	   		   $this->handleErr("Invalid query: " . mysql_error() . "\n Whole query: . " . $SQL );
		}
		return $result;
	}

	 function insert($SQL) {
		debug(2,$SQL);
		mysql_select_db($this->_database);
		if (mysql_query($SQL,$this->_conn)==false)		{
		   $this->handleErr("Invalid query: " . mysql_error()  . "\n Whole query: . " . $SQL );
		   return 0;
		}
		$i=mysql_insert_id();
		return 	$i;
	}
	
	 function SendMail ($subject, $body, $die) {

		
	$from="willis@triactassociates.com";
		$header = "Return-Path: $from\n";
		$header .= "X-Sender: $from\n";
		$header .= "From: Willis Miller <$from>\n";
		$header .= "X-Mailer:PHP 5.1\n";
		$header .= "MIME-Version: 1.0\n";
	
		if(mail("willis@triactassociates.com",$subject,$body,$header))
		{
			if ($die) {
				echo "<BR> Tech department notified.";
				die();
			}

		} else { 
			//insert error into db
		   echo "Message could not be sent. <p>";
		   echo $subject . "<BR>" . $body;
		   exit;

		}
}


	 function execSQL($SQL)  {
		debug(2,$SQL);
		mysql_select_db($this->_database);
		mysql_query($SQL,$this->_conn)
			or $this->handleErr("Invalid query::" . $SQL . mysql_error());
		
	}
	 function execScalar($SQL, $nodebug=0) {
		debug(2,$SQL);
		mysql_select_db($this->_database);
		if (!$result=mysql_query($SQL,$this->_conn))
		{
		   $this->handleErr("Invalid query: " . mysql_error() . "\n Whole query: . " . $SQL );
		}
		$r="";
	
	   if ($row = mysql_fetch_array($result)) {
		   $r=$row[0];
	   } 
	   mysql_free_result($result);
	   return $r;
	   
	}

}

?>