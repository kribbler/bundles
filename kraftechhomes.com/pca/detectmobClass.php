<?php
//**************************
// The uagent_info class encapsulates information about
//   a browser's connection to your web site. 
//   The object's methods return 1 for true, or 0 for false.
class uagent_info
{
   //Stores some info about the browser and device.
   var $useragent = "";

   //Stores info about what content formats the browser can display.
   var $httpaccept = ""; 

   // Standardized (and configurable) values for true and false.
   var $true = 1;
   var $false = 0;

   // A long list of strings which provide clues 
   //   about devices and capabilities.
   var $deviceIphone = 'iphone';
   var $deviceIpod = 'ipod';
   
   var $deviceS60 = "series60";
   var $deviceSymbian = "symbian";


   // [ SNIP! Other variables snipped out ] 


   //**************************
   //The constructor. Initializes several default variables.
   function uagent_info()
   { 
       $this->useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
       $this->httpaccept = strtolower($_SERVER['HTTP_ACCEPT']);
   }

   //**************************
   //Returns the contents of the User Agent value, in lower case.
   function Get_Uagent()
   { 
       return $this->useragent;
   }

   //**************************
   // Detects if the current device is an iPhone.
   function DetectIphone()
   {
      if (stripos($this->useragent, $this->deviceIphone) > -1)
      {
         //The iPod touch says it's an iPhone! So let's disambiguate.
         if ($this->DetectIpod() == $this->true)
         {
            return $this->false;
         }
         else
            return $this->true; 
      }
      else
         return $this->false; 
   }

   // [ SNIP! Other functions snipped out ] 

   function DetectS60OssBrowser()
   {
      if (stripos($this->useragent, $this->deviceS60) > -1)
      {         
         
            return $this->true; 
      }
      else
         return $this->false; 
   }


   function DetectSymbianOS()
   {
      if (stripos($this->useragent, $this->deviceSymbian) > -1)
      {         
         
            return $this->true; 
      }
      else
         return $this->false; 
   }






    function showalert()
   {
      $str = "HELLLLLLLLLO123";
	  return $str; 
   }

}

?>
