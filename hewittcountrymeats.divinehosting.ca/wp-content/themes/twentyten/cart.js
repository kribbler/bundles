        jQuery(document).ready(function(){
			var strnull = '';
			var formname = '.paypal_form';
			jQuery('.sample_bag').change(function() {
			if(jQuery('.sample_bag').val() != "Select")
			{
				jQuery('.item_name_1').remove();
				jQuery('.amount_1').remove();
				var c=jQuery('select.sample_bag')[0];
				c=parseInt(jQuery(c.options[c.selectedIndex]).text());
				jQuery('.samplebag_unitprice').val('$'+(jQuery('select.sample_bag option:selected').val()/c));
				jQuery('.samplebag_subtotal').val('$'+jQuery('select.sample_bag option:selected').val());
				jQuery('.paypal_form').append('<input type="hidden" class="item item_name_1" name="item_name_1" value="'+c+' x 3 Stick Sample Bag">');
				
				switch(jQuery('select.sample_bag option:selected').text())
				{
					case '1':
						jQuery('.samplebag_sh').val('$'+3);
					     break;
					case '2':
						jQuery('.samplebag_sh').val('$'+5.50);
					     break;
					case '3':
						jQuery('.samplebag_sh').val('$'+8);
					     break;
					case '4':
						jQuery('.samplebag_sh').val('$'+10.50);
					     break;
					case '5':
						jQuery('.samplebag_sh').val('$'+12);
					     break;
  				    case '-Select-':
						jQuery('.samplebag_sh').val('$'+0);
						break;
				}
				var samplebag_total = parseFloat(jQuery('.samplebag_subtotal').val().replace('$', '')) + 
				parseFloat(jQuery('.samplebag_sh').val().replace('$', ''));
				jQuery('.samplebag_total').val('$'+samplebag_total);
				var amount_tag1 = '<input type="hidden" class="amt amount_1" name="amount_1" value="'+samplebag_total+'">'
				jQuery('.paypal_form').append(amount_tag1);
				totalvalue();
				totalshvalue();
				grandtotal();
			 }
			 else
			 {
			 	jQuery('.samplebag_unitprice').val(strnull);
				jQuery('.samplebag_subtotal').val(strnull);
				jQuery('.samplebag_total').val(strnull);
				jQuery('.samplebag_sh').val(strnull);
				totalvalue();
				totalshvalue();
				grandtotal();
				jQuery('.item_name_1').remove();
				jQuery('.amount_1').remove();
			 }
			});
			
			jQuery('.half_bag').change(function() {
				if(jQuery('.half_bag').val() != "Select")
			{
				jQuery('.item_name_2').remove();
				jQuery('.amount_2').remove();
				var c=jQuery('select.half_bag')[0];
				c=parseInt(jQuery(c.options[c.selectedIndex]).text());
				jQuery('.halfbag_unitprice').val('$'+Math.round((jQuery('select.half_bag option:selected').val()/c)*100)/100);
				jQuery('.halfbag_subtotal').val('$'+jQuery('select.half_bag option:selected').val());
				jQuery('.paypal_form').append('<input type="hidden" class="item item_name_2" name="item_name_2" value="'+c+' x 1/2 Bag (15 Sticks)">');
				jQuery('.halfbag_sh').val('$'+12);
				//var halfbag_total = parseFloat(jQuery('.halfbag_subtotal').val().replace('$', '')) + parseFloat(jQuery('.halfbag_sh').val().replace('$', ''));
				var halfbag_total = parseFloat(jQuery('.halfbag_subtotal').val().replace('$', ''));
				jQuery('.halfbag_total').val('$'+halfbag_total);
				var amount_tag2 = '<input type="hidden" class="amt amount_2" name="amount_2" value="'+halfbag_total+'">'
				jQuery('.paypal_form').append(amount_tag2);
				totalvalue();
				totalshvalue();
				grandtotal();
			}
			else
			{
			 	jQuery('.halfbag_unitprice').val(strnull);
				jQuery('.halfbag_subtotal').val(strnull);
				jQuery('.halfbag_total').val(strnull);
				jQuery('.halfbag_sh').val(strnull);
				totalvalue();
				totalshvalue();
				grandtotal();
				jQuery('.item_name_2').remove();
				jQuery('.amount_2').remove();
			}
			});
			jQuery('.full_bag').change(function() {
			if(jQuery('.full_bag').val() != "Select")
			{
				jQuery('.item_name_3').remove();
				jQuery('.amount_3').remove();
				var c=jQuery('select.full_bag')[0];
				c=parseInt(jQuery(c.options[c.selectedIndex]).text());
				jQuery('.fullbag_unitprice').val('$'+(jQuery('select.full_bag option:selected').val()/c));
				jQuery('.fullbag_subtotal').val('$'+jQuery('select.full_bag option:selected').val());
				jQuery('.paypal_form').append('<input type="hidden" class="item item_name_3" name="item_name_3" value="'+c+' x Full Bag (30 Sticks)">');
				jQuery('.fullbag_sh').val('$'+12);
				//var fullbag_total = parseFloat(jQuery('.fullbag_subtotal').val().replace('$', '')) + parseFloat(jQuery('.fullbag_sh').val().replace('$', ''));
				var fullbag_total = parseFloat(jQuery('.fullbag_subtotal').val().replace('$', ''));
				jQuery('.fullbag_total').val('$'+fullbag_total);
				var amount_tag3 = '<input type="hidden" class="amt amount_3" name="amount_3" value="'+fullbag_total+'">'
				jQuery('.paypal_form').append(amount_tag3);
				totalvalue();
				totalshvalue();
				grandtotal();
			}
			else
			{
				jQuery('.fullbag_unitprice').val(strnull);
				jQuery('.fullbag_subtotal').val(strnull);
				jQuery('.fullbag_total').val(strnull);
				jQuery('.fullbag_sh').val(strnull);
				totalvalue();
				totalshvalue();
				grandtotal();
				jQuery('.item_name_3').remove();
				jQuery('.amount_3').remove();
			}
			});

        	jQuery('.full_bag2').change(function() {
			if(jQuery('.full_bag2').val() != "Select")
			{
				jQuery('.item_name_4').remove();
				jQuery('.amount_3').remove();
				var c=jQuery('select.full_bag2')[0];
				c=parseInt(jQuery(c.options[c.selectedIndex]).text());
				jQuery('.fullbag2_unitprice').val('$'+(jQuery('select.full_bag2 option:selected').val()/c));
				jQuery('.fullbag2_subtotal').val('$'+jQuery('select.full_bag2 option:selected').val());
				jQuery('.paypal_form').append('<input type="hidden" class="item item_name_4" name="item_name_4" value="Daves Smokin Jalapeno Beef Jerky '+c+' x Full Bag">');
				jQuery('.fullbag2_sh').val('$'+12);
				//var fullbag2_total = parseFloat(jQuery('.fullbag2_subtotal').val().replace('$', '')) + parseFloat(jQuery('.fullbag2_sh').val().replace('$', ''));
				var fullbag2_total = parseFloat(jQuery('.fullbag2_subtotal').val().replace('$', ''));
				jQuery('.fullbag2_total').val('$'+fullbag2_total);
				var amount_tag4 = '<input type="hidden" class="amt amount_4" name="amount_4" value="'+fullbag2_total+'">'
				jQuery('.paypal_form').append(amount_tag4);
				totalvalue();
				totalshvalue();
				grandtotal();
			}
			else
			{
				jQuery('.fullbag2_unitprice').val(strnull);
				jQuery('.fullbag2_subtotal').val(strnull);
				jQuery('.fullbag2_total').val(strnull);
				jQuery('.fullbag2_sh').val(strnull);
				totalvalue();
				totalshvalue();
				grandtotal();
				jQuery('.item_name_4').remove();
				jQuery('.amount_4').remove();
			}
			});

        	jQuery('.half_bag2').change(function() {
				if(jQuery('.half_bag2').val() != "Select")
			{
				jQuery('.item_name_5').remove();
				jQuery('.amount_5').remove();
				var c=jQuery('select.half_bag2')[0];
				c=parseInt(jQuery(c.options[c.selectedIndex]).text());
				jQuery('.halfbag2_unitprice').val('$'+Math.round((jQuery('select.half_bag2 option:selected').val()/c)*100)/100);
				jQuery('.halfbag2_subtotal').val('$'+jQuery('select.half_bag2 option:selected').val());
				jQuery('.paypal_form').append('<input type="hidden" class="item item_name_5" name="item_name_5" value="Daves Smokin Jalapeno Beef Jerky '+c+' x 1/2 Bag">');
				jQuery('.halfbag2_sh').val('$'+12);
				//var halfbag2_total = parseFloat(jQuery('.halfbag2_subtotal').val().replace('$', '')) + parseFloat(jQuery('.halfbag2_sh').val().replace('$', ''));
				var halfbag2_total = parseFloat(jQuery('.halfbag2_subtotal').val().replace('$', ''));
				jQuery('.halfbag2_total').val('$'+halfbag2_total);
				var amount_tag5 = '<input type="hidden" class="amt amount_5" name="amount_5" value="'+halfbag2_total+'">'
				jQuery('.paypal_form').append(amount_tag5);
				totalvalue();
				totalshvalue();
				grandtotal();
			}
			else
			{
			 	jQuery('.halfbag2_unitprice').val(strnull);
				jQuery('.halfbag2_subtotal').val(strnull);
				jQuery('.halfbag2_total').val(strnull);
				jQuery('.halfbag2_sh').val(strnull);
				totalvalue();
				totalshvalue();
				grandtotal();
				jQuery('.item_name_5').remove();
				jQuery('.amount_5').remove();
			}
			});




        	jQuery('.full_bag3').change(function() {
			if(jQuery('.full_bag3').val() != "Select")
			{
				jQuery('.item_name_6').remove();
				jQuery('.amount_6').remove();
				var c=jQuery('select.full_bag3')[0];
				c=parseInt(jQuery(c.options[c.selectedIndex]).text());
				jQuery('.fullbag3_unitprice').val('$'+(jQuery('select.full_bag3 option:selected').val()/c));
				jQuery('.fullbag3_subtotal').val('$'+jQuery('select.full_bag3 option:selected').val());
				jQuery('.paypal_form').append('<input type="hidden" class="item item_name_6" name="item_name_6" value="Daves New Snackin Chew Beef Jerky '+c+' x Full Bag">');
				jQuery('.fullbag3_sh').val('$'+12);
				//var fullbag3_total = parseFloat(jQuery('.fullbag3_subtotal').val().replace('$', '')) + parseFloat(jQuery('.fullbag3_sh').val().replace('$', ''));
				var fullbag3_total = parseFloat(jQuery('.fullbag3_subtotal').val().replace('$', ''));
				jQuery('.fullbag3_total').val('$'+fullbag3_total);
				var amount_tag6 = '<input type="hidden" class="amt amount_6" name="amount_6" value="'+fullbag3_total+'">'
				jQuery('.paypal_form').append(amount_tag6);
				totalvalue();
				totalshvalue();
				grandtotal();
			}
			else
			{
				jQuery('.fullbag3_unitprice').val(strnull);
				jQuery('.fullbag3_subtotal').val(strnull);
				jQuery('.fullbag3_total').val(strnull);
				jQuery('.fullbag3_sh').val(strnull);
				totalvalue();
				totalshvalue();
				grandtotal();
				jQuery('.item_name_6').remove();
				jQuery('.amount_6').remove();
			}
			});

        	jQuery('.half_bag3').change(function() {
				if(jQuery('.half_bag3').val() != "Select")
			{
				jQuery('.item_name_7').remove();
				jQuery('.amount_7').remove();
				var c=jQuery('select.half_bag3')[0];
				c=parseInt(jQuery(c.options[c.selectedIndex]).text());
				jQuery('.halfbag3_unitprice').val('$'+Math.round((jQuery('select.half_bag3 option:selected').val()/c)*100)/100);
				jQuery('.halfbag3_subtotal').val('$'+jQuery('select.half_bag3 option:selected').val());
				jQuery('.paypal_form').append('<input type="hidden" class="item item_name_7" name="item_name_7" value="Daves New Snackin Chew Beef Jerky '+c+' x 1/2 Bag">');
				jQuery('.halfbag3_sh').val('$'+12);
				//var halfbag3_total = parseFloat(jQuery('.halfbag3_subtotal').val().replace('$', '')) + parseFloat(jQuery('.halfbag3_sh').val().replace('$', ''));
				var halfbag3_total = parseFloat(jQuery('.halfbag3_subtotal').val().replace('$', ''));
				jQuery('.halfbag3_total').val('$'+halfbag3_total);
				var amount_tag7 = '<input type="hidden" class="amt amount_7" name="amount_7" value="'+halfbag3_total+'">'
				jQuery('.paypal_form').append(amount_tag7);
				totalvalue();
				totalshvalue();
				grandtotal();
			}
			else
			{
			 	jQuery('.halfbag3_unitprice').val(strnull);
				jQuery('.halfbag3_subtotal').val(strnull);
				jQuery('.halfbag3_total').val(strnull);
				jQuery('.halfbag3_sh').val(strnull);
				totalvalue();
				totalshvalue();
				grandtotal();
				jQuery('.item_name_7').remove();
				jQuery('.amount_7').remove();
			}
			});

        	jQuery('.counter_jar').change(function() {
				if(jQuery('.counter_jar').val() != "Select")
			{
				jQuery('.item_name_8').remove();
				jQuery('.amount_8').remove();
				var c=jQuery('select.counter_jar')[0];
				c=parseInt(jQuery(c.options[c.selectedIndex]).text());
				jQuery('.counterjar_unitprice').val('$'+Math.round((jQuery('select.counter_jar option:selected').val()/c)*100)/100);
				jQuery('.counterjar_subtotal').val('$'+jQuery('select.counter_jar option:selected').val());
				jQuery('.paypal_form').append('<input type="hidden" class="item item_name_8" name="item_name_8" value="'+c+' Retail Counter Jar">');
				jQuery('.counterjar_sh').val('$'+12);
				//var counterjar_total = parseFloat(jQuery('.counterjar_subtotal').val().replace('$', '')) + parseFloat(jQuery('.counterjar_sh').val().replace('$', ''));
				var counterjar_total = parseFloat(jQuery('.counterjar_subtotal').val().replace('$', ''));
				jQuery('.counterjar_total').val('$'+counterjar_total);
				var amount_tag8 = '<input type="hidden" class="amt amount_8" name="amount_8" value="'+counterjar_total+'">'
				jQuery('.paypal_form').append(amount_tag8);

				totalvalue();
				totalshvalue();
				grandtotal();
			}
			else
			{
			 	jQuery('.counterjar_unitprice').val(strnull);
				jQuery('.counterjar_subtotal').val(strnull);
				jQuery('.counterjar_total').val(strnull);
				jQuery('.counterjar_sh').val(strnull);
				totalvalue();
				totalshvalue();
				grandtotal();
				jQuery('.item_name_8').remove();
				jQuery('.amount_8').remove();
			}
			});

        	var my_shipping = '<input type="hidden" name="handling_cart" value="12" />';
			jQuery('.paypal_form').append(my_shipping);
        	

			function totalvalue()
			{
				if(jQuery('.samplebag_subtotal').val() != "")
				  {
				  	var samplebag_total1 = jQuery('.samplebag_subtotal').val().replace('$', '');
				  }
				  else
				  {
				  	var samplebag_total1 = 0;
				  }
			
				  if(jQuery('.halfbag_subtotal').val() != "")
				  {
				  	var halfbag_total1 = jQuery('.halfbag_subtotal').val().replace('$', '');
				  }
				  else
				  {
				  	var halfbag_total1 = 0;
				  }

				  if(jQuery('.halfbag2_subtotal').val() != "")
				  {
				  	var halfbag2_total1 = jQuery('.halfbag2_subtotal').val().replace('$', '');
				  }
				  else
				  {
				  	var halfbag2_total1 = 0;
				  }
				  
				  if(jQuery('.halfbag3_subtotal').val() != "")
				  {
				  	var halfbag3_total1 = jQuery('.halfbag3_subtotal').val().replace('$', '');
				  }
				  else
				  {
				  	var halfbag3_total1 = 0;
				  }
				  

				  if(jQuery('.fullbag_subtotal').val() != "")
				  {
				  	var fullbag_total1 = jQuery('.fullbag_subtotal').val().replace('$', '');
				  }
				  else
				  {
				  		var fullbag_total1 = 0;
				  }
				  if(jQuery('.fullbag2_subtotal').val() != "")
				  {
				  	var fullbag2_total1 = jQuery('.fullbag2_subtotal').val().replace('$', '');
				  }
				  else
				  {
				  		var fullbag2_total1 = 0;
				  }

				  if(jQuery('.fullbag3_subtotal').val() != "")
				  {
				  	var fullbag3_total1 = jQuery('.fullbag3_subtotal').val().replace('$', '');
				  }
				  else
				  {
				  		var fullbag3_total1 = 0;
				  }

				  if(jQuery('.counterjar_subtotal').val() != "")
				  {
				  	var counterjar_total1 = jQuery('.counterjar_subtotal').val().replace('$', '');
				  }
				  else
				  {
				  		var counterjar_total1 = 0;
				  }

				var subtotalamount =  
					parseFloat(samplebag_total1) + 
					parseFloat(halfbag_total1) + 
					parseFloat(halfbag2_total1) + 
					parseFloat(halfbag3_total1) + 
					parseFloat(fullbag_total1) +
					parseFloat(fullbag2_total1) + 
					parseFloat(fullbag3_total1) + 
					parseFloat(counterjar_total1);
				jQuery('.subtotal').val('$'+subtotalamount);
			}
			function totalshvalue()
			{
				if(jQuery('.samplebag_sh').val() != "")
				  {
				  	var samplebag_sh1 = jQuery('.samplebag_sh').val().replace('$', '');
				  }
				  else
				  {
				  	var samplebag_sh1 = 0;
				  }
			
				  if(jQuery('.halfbag_sh').val() != "")
				  {
				  	var halfbag_sh1 = jQuery('.halfbag_sh').val().replace('$', '');
				  }
				  else
				  {
				  	var halfbag_sh1 = 0;
				  }

				  if(jQuery('.halfbag2_sh').val() != "")
				  {
				  	var halfbag2_sh1 = jQuery('.halfbag2_sh').val().replace('$', '');
				  }
				  else
				  {
				  	var halfbag2_sh1 = 0;
				  }

				  if(jQuery('.halfbag3_sh').val() != "")
				  {
				  	var halfbag3_sh1 = jQuery('.halfbag3_sh').val().replace('$', '');
				  }
				  else
				  {
				  	var halfbag3_sh1 = 0;
				  }

				  if(jQuery('.fullbag_sh').val() != "")
				  {
				  	var fullbag_sh1 = jQuery('.fullbag_sh').val().replace('$', '');
				  }
				  else
				  {
				  		var fullbag_sh1 = 0;
				  }

				  if(jQuery('.fullbag2_sh').val() != "")
				  {
				  	var fullbag2_sh1 = jQuery('.fullbag2_sh').val().replace('$', '');
				  }
				  else
				  {
				  		var fullbag2_sh1 = 0;
				  }

				  if(jQuery('.fullbag3_sh').val() != "")
				  {
				  	var fullbag3_sh1 = jQuery('.fullbag3_sh').val().replace('$', '');
				  }
				  else
				  {
				  		var fullbag3_sh1 = 0;
				  }

				  if(jQuery('.counterjar_sh').val() != "")
				  {
				  	var counterjar_sh1 = jQuery('.counterjar_sh').val().replace('$', '');
				  }
				  else
				  {
				  		var counterjar_sh1 = 0;
				  }

				  if (halfbag_sh1 || fullbag_sh1 || 
				  		fullbag2_sh1 || halfbag2_sh1 || 
				  		fullbag3_sh1 || halfbag3_sh1 ||
				  		counterjar_sh1) {
					  fullbag_sh1=12;
					  halfbag_sh1=0;
					  fullbag2_sh1 = 12;
					  halfbag2_sh1 = 0;
					  fullbag3_sh1 = 12;
					  halfbag3_sh1 = 0;
					  counterjar_sh1 = 12;
				  }
				  
				var shtotalamount =  parseFloat(samplebag_sh1) + 
					parseFloat(halfbag_sh1) +
					parseFloat(halfbag2_sh1) + 
					parseFloat(halfbag3_sh1) + 
					parseFloat(fullbag_sh1) + 
					parseFloat(fullbag2_sh1) +
					parseFloat(fullbag3_sh1) + 
					parseFloat(counterjar_sh1);
				if (samplebag_sh1 && (halfbag_sh1 || fullbag_sh1) && 
					(halfbag2_sh1 || fullbag2_sh1) && 
					(halfbag3_sh1 || fullbag3_sh1) && 
					shtotalamount>12 && counterjar_sh1) {
					shtotalamount=12;
				}

				if (shtotalamount > 0) {
					shtotalamount = 12;
				}
				jQuery('.sh').val('$'+shtotalamount);
			}
			function grandtotal()
			{
				if(jQuery('.subtotal').val() != "")
				{
					var subtotal =  jQuery('.subtotal').val().replace('$', '');
				}
				else
				{
					var subtotal = 0;
				}
				if(jQuery('.sh').val() != "")
				{
					var shtotal =  jQuery('.sh').val().replace('$', '');
				}
				else
				{
					var shtotal = 0;
				}
				var grandtotalamount =  parseFloat(subtotal) + parseFloat(shtotal);
				jQuery('.grandtotal').val('$'+grandtotalamount);
				
				var t=1;
				jQuery('.item').each(function() {
					jQuery(this).attr('name','item_name_'+t);
					t+=1;
				});
				var t=1;
				jQuery('.amt').each(function() {
					jQuery(this).attr('name','amount_'+t);
					t+=1;
				});


			}
			function validateEmail(sEmail) {
				var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
				if (filter.test(sEmail)) {
					return true;
				}
				else {
					return false;
				}
			}
			 jQuery("form.paypal_form").submit(function() {
				 if(jQuery('.full_bag').val() != "Select" || 
				 	jQuery('.half_bag').val() != "Select" || 
				 	jQuery('.sample_bag').val() != "Select" ||
				 	jQuery('.half_bag2').val() != "Select" || 
				 	jQuery('.full_bag2').val() != "Select" || 
				 	jQuery('.half_bag3').val() != "Select" || 
				 	jQuery('.full_bag3').val() != "Select" || 
				 	jQuery('.counter_jar').val() != "Select")
				{
					var firstnameVal = jQuery(".firstname").val();
					var lastnameval = jQuery(".lastname").val();
					var phoneval = jQuery(".phone").val();
					var emailval = jQuery(".email").val();
					var addressval = jQuery(".address").val();
					var cityval = jQuery(".city").val();
					var postalval = jQuery(".postal").val();
				  	if(jQuery.trim(firstnameVal) == "") {
						alert('First Name is required');
						jQuery(".firstname").focus();
						return false;
				 	 }
					if(jQuery.trim(lastnameval) == "")
					{
						alert('Last Name is required');
						jQuery(".lastname").focus();
						return false;
					}
					if(jQuery.trim(emailval) == "")
					{
						alert('Email is Required');
						jQuery(".email").focus();
						return false;
					}
					else if(!validateEmail(emailval))
					{
						alert('Invalid Email Address');
						jQuery(".email").focus();
						return false;
					}
					if(jQuery.trim(phoneval) == "")
					{
						alert('Phone Number is not valid');
						jQuery(".phone").focus();
						return false;
					}
					if(jQuery.trim(addressval) == "")
					{
						alert('Address is required');
						jQuery(".address").focus();
						return false;
					}
					if(jQuery.trim(cityval) == "")
					{
						alert('City is required');
						jQuery(".city").focus();
						return false;
					}
					if(jQuery.trim(postalval) == "")
					{
						alert('postal code is required');
						jQuery(".postal").focus();
						return false;
					}
				}
				else
				{
					alert('Select the Product');
					return false;
				}
				
			});
       });