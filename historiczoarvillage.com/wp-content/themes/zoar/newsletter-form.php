  <div class="step_form">
    <form name="application" id="application" action="<?php bloginfo('template_url');?>/newsletter_subscription.php" method="post">
      <p>
        <label>Name *</label>
        <input type="text"  name="name" id="name" value="" />
      </p>
      <p>
        <input type="radio" name="subscribe" id="subscribe" value="news_mail" onClick="show_hide('news','mail')" />        Please mail me the printed copy of the newsletter Mailing address: <br />
       </p>
      <div id="news" style="display:none;">
      <p>
        <label>Address *</label>
        <input type="text"  name="address" id="address" value="<?php echo $address; ?>" />
      </p>
      <p>
        <label>Address 2 *</label>
        <input type="text"  name="address1" id="address1" value="<?php echo $address1; ?>" />
      </p>
      <p>
        <label>City *</label>
        <input type="text"  name="city" id="city" value="<?php echo $city; ?>" />
      </p>
      <p>
        <label>State</label>
        <input type="text"  name="state" id="state" value="<?php echo $state; ?>" />
      </p>
      <p>
        <label>Zip Code</label>
        <input type="text"  name="zip_code" id="zip_code" value="<?php echo $zip_code; ?>" />
      </p>
      </div>
      <p>
      <input type="radio" name="subscribe" id="subscribe" value="news_email" onClick="show_hide('mail','news')" />        I prefer to receive the newsletter via email as a PDF. Email address: <br />
      </p>
      <div id="mail" style="display:none;">
        <label>Email *</label>
        <input type="text"  name="email" id="email" value="<?php echo $email; ?>" />
      </div>
      <div style="float:none; padding-right:100px; ">
        <input type="submit"  name="next" value="Sign Up"  onclick="return application_valid();"/>
      </div>
     
    </form>
      </div>
<script type="text/javascript" language="javascript">
function show_hide(show,hide)
{

document.getElementById(show).style.display="block";
document.getElementById(hide).style.display="none";

}


function application_valid()
{
	var obj=document.application;
	
	if(obj.name.value=="")
	{
		alert("Please Enter your name");
		obj.name.focus();
		return false;
	}
	
	if( (obj.subscribe[0].checked==false) && (obj.subscribe[1].checked==false))
	{
		alert("Please checked newsletter subscription");
		return false;
	}
	if(obj.subscribe[0].checked==true)
	{
		if(obj.address.value=="")
		{
			alert("Please Enter your address");
			obj.address.focus();
			return false;
		}
		
		if(obj.address1.value=="")
		{
			alert("Please Enter your address 2");
			obj.address1.focus();
			return false;
		}
		
		if(obj.city.value=="")
		{
			alert("Please Enter your city ");
			obj.city.focus();
			return false;
		}
	}
	if(obj.subscribe[1].checked==true)
	{
		var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var address = obj.email.value;
		if(reg.test(address) == false) 
		{
		  alert('Please Enter valid Email Address');
		  obj.email.focus();
		  return false;
		}
	}
		
	else
	{
		return true;
	}
}
</script>
