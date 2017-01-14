
var uagent = navigator.userAgent.toLowerCase();

var deviceIphone = "iphone";
var deviceIpod = "ipod";

var deviceS60 = "series60";
var deviceSymbian = "symbian";
var engineWebKit = "webkit";

var deviceAndroid = "android";

var deviceWinMob = "windows ce";

var deviceBB = "blackberry";
var uagent = navigator.userAgent.toLowerCase();

var devicePalm = "palm";
var uagent = navigator.userAgent.toLowerCase();



// Detects if the current device is an iPhone.
function DetectIphone()
{
   if (uagent.search(deviceIphone) > -1)
       location.href='http://www.kraftechhomes.com/home_mobile.php';
   else
      return false;
}



//**************************
// Detects if the current device is an iPod Touch.
function DetectIpod()
{
   if (uagent.search(deviceIpod) > -1)
       location.href='http://www.kraftechhomes.com/home_mobile.php';
   else
        return false;
}


// Detects if the current browser is the S60 Open Source Browser.
// Screen out older devices and the old WML browser.
function DetectS60OssBrowser()
{
   if (uagent.search(engineWebKit) > -1)
   {
     if ((uagent.search(deviceS60) > -1 || 
          uagent.search(deviceSymbian) > -1))
       location.href='http://www.kraftechhomes.com/home_mobile.php';
     else
        return false;
   }
   else
      return false;
}


//**************************
// Detects if the current device is an Android OS-based device.
function DetectAndroid()
{
   if (uagent.search(deviceAndroid) > -1)
     location.href='http://www.kraftechhomes.com/home_mobile.php';
   else
      return false;
}


// Detects if the current device is an Android OS-based device and
//   the browser is based on WebKit.
function DetectAndroidWebKit()
{
   if (DetectAndroid())
   {
     if (DetectWebkit())
        location.href='http://www.kraftechhomes.com/home_mobile.php';
     else
        return false;
   }
   else
      return false;
}

// Detects if the current browser is a BlackBerry of some sort.
function DetectBlackBerry()
{
   if (uagent.search(deviceBB) > -1)
      location.href='http://www.kraftechhomes.com/home_mobile.php';
   else
      return false;
}

// Detects if the current browser is on a PalmOS device.
function DetectPalmOS()
{
   if (uagent.search(devicePalm) > -1)
      location.href='http://www.kraftechhomes.com/home_mobile.php';
   else
      return false;
}
}