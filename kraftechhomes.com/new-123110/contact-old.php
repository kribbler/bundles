<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kraftech Inc.</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>

<body id="contact">
<div id="container">
<div id="wraper">
<div class="header"><img src="images/header.jpg" width="919" height="137" /></div>
<div class="outline">
<div class="menu-bar">
<div class="logo-bal"><img src="images/logo-bal.jpg" width="121" height="44" /></div>
<div class="menu">

<?php include('nav.html') ?>
        
</div>

</div>
<div class="clear"></div>
<div class="middle">
<div class="left-col">
  <div class="custom-content">
  <div class="form">
 <h2> Contact Us</h2>
  <form id="contact" name="contact" method="post" action="submit.php" onSubmit="return Check();">
          <table align="center" border="0" cellpadding="0" cellspacing="0" width="500">
          <tbody><tr>
            <td width="68">Name:</td>
            <td><input name="name" id="name" style="width: 432px;" type="text" width="432"></td>
          </tr>
          <tr>
            <td colspan="2" style="height: 12px;" height="7"></td>
          </tr>
          <tr>
            <td>Email:</td>
            <td><input name="email" id="email" style="width: 432px;" type="text" width="432"></td>
          </tr>
          <tr>
            <td colspan="2" style="height: 12px;" height="7"></td>
          </tr>  
          <tr>
            <td>Address:</td>
            <td><input name="address" id="address" style="width: 432px;" type="text" width="432"></td>
          </tr>
          <tr>
            <td colspan="2" style="height: 12px;" height="7"></td>
          </tr>  
          <tr>
            <td width="68">City:</td>
            <td>
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody><tr>
                <td align="left"><input name="city" id="city" style="width: 150px;" type="text" width="150"></td>
                <td align="center">State:&nbsp;<input name="state" id="state" style="width: 30px;" type="text" width="30"></td>
                <td align="right">Zip Code:&nbsp;<input name="zip" id="zip" style="width: 80px;" type="text" width="80"></td>    
              </tr>        
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="height: 12px;" height="7"></td>
          </tr>  
          <tr>
            <td width="68">Phone:</td>  
            <td>
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
              <tbody><tr>
                <td><input name="phone" id="phone" style="width: 150px;" type="text" width="150"></td>
                <td align="right">Contact me:&nbsp;
                  <select name="contact_me" id="contact_me">
                    <option value="by phone" selected="selected">by phone</option>
                    <option value="by email">by email</option>
                  </select>        
                </td>
              </tr>        
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="height: 14px;" height="10"></td>
          </tr>  
          <tr>
            <td colspan="2">How did you hear of us?:</td>
          </tr>
          <tr>
            <td colspan="2" style="height: 14px;" height="10"></td>
          </tr>    
          <tr>
            <td colspan="2">
              <table border="0" cellpadding="0" cellspacing="0" width="500">
              <tbody><tr>
                <td><input id="hear" name="hear" value="Search Engine" type="radio">&nbsp;Search Engine</td>
                <td><input id="hear" name="hear" value="Newspaper Ad" type="radio">&nbsp;Newspaper Ad</td>
                <td><input id="hear" name="hear" value="Yard Sign" type="radio">&nbsp;Yard Sign</td>
                <td><input id="hear" name="hear" value="Referral" type="radio">&nbsp;Referral</td>
                <td><input id="hear" name="hear" value="Other" type="radio">&nbsp;Other</td>        
              </tr>
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="height: 14px;" height="10"></td>
          </tr>    
          <tr>
            <td colspan="2">When Are You Looking To Move?:&nbsp;
              <select name="looking" id="looking">
                <option value="Immediately" selected="selected">Immediately</option>
                <option value="3 to 6 Months">3 to 6 Months</option>
                <option value="6-12 Months">6-12 Months</option>
                <option value="Just Looking">Just Looking</option>        
              </select>    
            </td>
          </tr>
          <tr>
            <td colspan="2" style="height: 14px;" height="10"></td>
          </tr>   
          <tr>
            <td colspan="2">
              <table border="0" cellpadding="0" cellspacing="0" width="500">
              <tbody><tr>
                <td align="left" width="200">
                  <input id="sell" name="sell" value="Yes" type="checkbox">We have a home to sell        
                </td>
                <td align="right" width="300">
                  Was this site helpful?&nbsp;
                  <input id="helpful" name="helpful" value="Yes" type="radio">&nbsp;Yes&nbsp;&nbsp;
                  <input id="helpful" name="helpful" value="No" type="radio">&nbsp;No        
                </td>
              </tr>
              </tbody></table>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="height: 14px;" height="10"></td>
          </tr>       
          <tr>
            <td colspan="2">
              Comments:<br>
              <textarea name="comments" id="comments" rows="7" width="500px" style="width: 500px;"></textarea>
            </td>
          </tr>    
          <tr>
            <td colspan="2" style="height: 14px;" height="10"></td>
          </tr>  
          <tr>
            <td colspan="2">
              <table border="0" cellpadding="0" cellspacing="0" width="500">
              <tbody><tr>
                <td align="center">
                  <div id="message" style="color: rgb(255, 0, 0); font-size: 12px;" align="center">
                  	* Please type characters in white box and hit submit<br>
                    * Name and Email Address are Required
                  </div>
                </td>
                <td align="center">
                  <img src="images/CAPTCHA_1278570596_61_5601.jpg" style="border: 1px solid rgb(0, 0, 0); margin: 2px;" alt="CAPTCHA Image" width="130" height="30"><br>
					<input size="5" name="captcha_input" value="" type="text">        
                  &nbsp;&nbsp;&nbsp;
                  <input id="submit" name="submit" value="Submit" type="submit">
                </td>      
              </tr>
              </tbody></table>
            </td>
          </tr>      
          </tbody></table>
      	</form>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  </div>
  
  
  

  
  </div>


</div>
<div class="right-col">

<?php include('sidebar.html'); ?>

</div>

</div>

</div>

<div class="footer-line"><img src="images/footer.jpg" width="919" height="5" /></div>
<div class="footer">

<?php include('footer.html'); ?>            
            
</div>


</div>
</div>
</div>
</body>
</html>
