<?php
/**
 *Template Name: Membership
 */
get_header(); 

?>

		<div id="container">
			<div id="content" role="main">

			<?php
			/* Run the loop to output the page.
			 * If you want to overload this in a child theme then include a file
			 * called loop-page.php and that will be used instead.
			 */
			get_template_part( 'loop', 'page' );
			?>
            <div class="membership_form">
    <form name="application" id="application" action="<?php bloginfo('template_url');?>/submit_subscription.php" method="post">
      <p>
        <label>Name *</label>
        <input type="text"  name="name" id="name" value="" />
      </p>
      <p>
        <label>Email *</label>
        <input type="text"  name="email" id="email" value="<?php echo $email; ?>" />
       </p>
      <p>
        <label>Phone *</label>
        <input type="text"  name="phone" id="phone" value="<?php echo $phone; ?>" />
       </p>
      <p>
        <label>Address *</label>
        <input type="text"  name="address" id="address" value="<?php echo $address; ?>" />
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
      <p>
        <label>Membership Plan*</label>
        <select id="mem_plan" name="mem_plan" required="required" class="memSelectbox">
        <option value="">- - - Select Plan - - -</option>
        <option value="Individual $20">Individual $20</option>
        <option value="Family $30">Family $30</option>
        <option value="Corporate $30">Corporate $30</option>
        <option value="Patron $50">Patron $50</option>
        <option value="Sustaining $100">Sustaining $100</option>
        <option value="Lifetime $250">Lifetime $250</option>        
        </select>
      </p>
      <p>
        <label>&nbsp;</label>
        <input type="checkbox"  name="renew" id="renew" value="yes" /> Renew my membership after 1 year 
      </p>
      
      
            <div style="float:none; padding-right:100px; ">
        <input type="submit"  name="next" value="Submit"  onclick="return application_valid();"/>
      </div>
     
    </form>
      </div>
<script type="text/javascript" language="javascript">

function application_valid()
{
	var obj=document.application;
	
	if(obj.name.value=="")
	{
		alert("Please Enter your name");
		obj.name.focus();
		return false;
	}
	
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		var address = obj.email.value;
		if(reg.test(address) == false) 
		{
		  alert('Please Enter valid Email Address');
		  obj.email.focus();
		  return false;
		}
		
		if(obj.phone.value=="")
		{
			alert("Please Enter your phone no");
			obj.phone.focus();
			return false;
		}
		
		if(obj.address.value=="")
		{
			alert("Please Enter your address");
			obj.address.focus();
			return false;
		}
		
	
		if(obj.city.value=="")
		{
			alert("Please Enter your city ");
			obj.city.focus();
			return false;
		}
		if(obj.mem_plan.value=="")
		{
			alert("Please select membership plan ");
			obj.mem_plan.focus();
			return false;
		}
			
	else
	{
		return true;
	}
}
</script>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>